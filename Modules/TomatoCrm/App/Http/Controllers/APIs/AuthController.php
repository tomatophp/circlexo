<?php

namespace Modules\TomatoCrm\App\Http\Controllers\APIs;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use Modules\TomatoCrm\App\Events\AccountLogged;
use Modules\TomatoCrm\App\Events\AccountOTPCheck;
use Modules\TomatoCrm\App\Events\SendOTP;
use Modules\TomatoCrm\App\Events\AccountRegistered;
use Modules\TomatoCrm\App\Facades\TomatoAuth;
use Modules\TomatoCrm\App\Facades\TomatoCrm;
use Modules\TomatoCrm\App\Models\Account;
use App\Http\Controllers\Controller;

/**
 *
 */
class AuthController extends Controller
{
    public string $guard = 'web';

    public bool $otp = true;

    public string $model = Account::class;

    public string $loginBy = 'email';

    public string $loginType = 'email';

    public ?string $resource = null;

    /**
     *
     */
    public function __construct()
    {
        $this->guard = config('tomato-crm.guard');
        $this->otp = config('tomato-crm.required_otp');
        $this->model = config('tomato-crm.model');
        $this->loginBy = config('tomato-crm.login_by');
        $this->loginType = config('tomato-crm.login_by');
        $this->resource = config('tomato-crm.resource', null);
    }


    /**
     *  Login.
     *
     *  We are using bearer token auth system and you can get token by using this APIs.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            config('tomato-crm.login_by') => "required|string|max:255",
            'password' => "required|string|max:255|min:6",
        ]);

        $check = auth($this->guard)->attempt([
            "username" => $request->get($this->loginBy),
            "password" => $request->get('password')
        ]);

        if($check){
            $user = auth($this->guard)->user();
            if($user->is_active && $this->otp){
                $user->last_login = Carbon::now();
                $user->save();

                $token = $user->createToken($this->guard)->plainTextToken;
                $user->token = $token;

                AccountLogged::dispatch($this->model, $user->id);

                if($this->resource){
                    $user = $this->resource::make($user);
                }
                else {
                    $user = [
                        "token" => $user->token
                    ];
                }


                /**
                 * A user resource with Token.
                 *
                 * @status 200
                 * @body array{status: true, message: "Data Retrieved Successfully", data: array{token: string}}
                 */
                return response()->json([
                    'message'=> __("Data Retrieved Successfully"),
                    'data' => $user,
                    'status' => true
                ], 200);
            }
            else if(!$user->is_active && $this->otp){
                /**
                 * A user resource.
                 *
                 * @status 401
                 * @body array{status: false, message: "Your account is not active yet"}
                 */
                return response()->json([
                    'status' => false,
                    'message' => __("Your account is not active yet")
                ],401);
            }
            else if(!$this->otp) {
                $user->last_login = Carbon::now();
                $user->save();

                $token = $user->createToken($this->guard)->plainTextToken;
                $user->token = $token;

                AccountLogged::dispatch($this->model, $user->id);




                if($this->resource){
                    $user = $this->resource::make($user);
                }
                else {
                    $user = [
                        "token" => $user->token
                    ];
                }

                /**
                 * A user resource with Token.
                 *
                 * @status 200
                 * @body array{status: false, message: "Data Retrieved Successfully", data: array{token: string}}
                 */
                return response()->json([
                    'message'=> __("Data Retrieved Successfully"),
                    'data' => $user,
                    'status' => true
                ], 200);
            }
        }

        /**
         * If User Not Found or Password Is Not Correct
         *
         * @status 400
         * @body array{status: false, message: "Username Or Password Is Not Correct"}
         */
        return response()->json([
            'status' => false,
            'message' => __("Username Or Password Is Not Correct")
        ],400);

    }

    /**
     * Register.
     *
     * You can create a new account by use this API.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate(
            array_merge([
                'name' => "required|string|max:255",
                "phone" => "required|string|max:14|unique:accounts,phone",
                "email" => "required|string|email|max:255|unique:accounts,email",
                "password" => "required|confirmed|min:6|max:191"
            ], TomatoCrm::getApiValidationCreate())
        );

        $data = $request->all();

        if($this->loginBy === 'phone'){
            $data['username'] = $request->get('phone');
        }
        elseif($this->loginBy === 'email'){
            $data['username'] = $request->get('email');
        }

        $data['password'] = bcrypt($request->get('password'));

        $user = app($this->model)->create($data);

        if ($user) {
            //Set More Data to Meta
            foreach (TomatoCrm::getAttachedItems() as $key => $value) {
                if($value === 'media'){
                    if($request->hasFile($key)){
                        $user->addMedia($request->{$key})
                            ->preservingOriginal()
                            ->toMediaCollection($key);
                    }
                }
                else {
                    $user->meta($key, $request->get($key));
                }
            }
            if($this->otp){
                $user->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $user->save();

                SendOTP::dispatch($this->model, $user->id);
                AccountRegistered::dispatch($this->model, $user->id);

                /**
                 * Registeration Success and OTP Has been send with Service Provider.
                 *
                 * @status 200
                 * @body array{status: true, message: "An OTP Has been send to your email please check it"}
                 */
                return response()->json([
                    "status" => true,
                    "message" => 'An OTP Has been send to your '.$this->loginType . ' please check it',
                ]);
            }

            $token = $user->createToken($this->guard)->plainTextToken;
            $user->token = $token;

            AccountRegistered::dispatch($this->model, $user->id);
            if($this->resource){
                $user = $this->resource::make($user);
            }
            else {
                $user = [
                    "token" => $user->token
                ];
            }

            /**
             *  Registeration Success and we return Access Token.
             *
             * @status 200
             * @body array{status: true, message: "User registration success", data: array{token: string}}
             */
            return response()->json([
                "status" => true,
                "message" => __('User registration success'),
                "data" => $user
            ]);
        }

        /**
         *  Registeration Success and we return Access Token.
         *
         * @status 400
         * @body array{status: false, message: "User registration failed"}
         */
        return response()->json([
            "status" => false,
            "message" => __('User registration failed')
        ], 400);
    }

    /**
     * Resend OTP.
     *
     * You can resend OTP by use this API.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function resend(Request $request): JsonResponse
    {
        $request->validate([
            config('tomato-crm.login_by') => "required|exists:".app(config('tomato-crm.model'))->getTable().",username",
        ]);

        $checkIfEx = config('tomato-crm.model')::where("username", $request->get(config('tomato-crm.login_by')))->first();
        $checkIfEx->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $checkIfEx->save();

        SendOTP::dispatch(config('tomato-crm.model'), $checkIfEx->id);


        /**
         *  OTP Send Success Using Service Provider.
         *
         * @status 200
         * @body array{status: true, message: 'An OTP Has been send to your email please check it'}
         */
        return response()->json([
            "status" => true,
            "message" => 'An OTP Has been send to your '.$this->loginType . ' please check it'
        ], 200);
    }

    /**
     * Check OTP.
     *
     * You can check OTP is vaild by use this API.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function otpCheck(Request $request){
        $request->validate([
            config('tomato-crm.login_by') => 'required|string|max:255',
            'otp_code' => 'required|string|max:6',
        ]);

        $user = app(config('tomato-crm.model'))->where("username", $request->get(config('tomato-crm.login_by')))->first();

        if ($user) {
            if ((!empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                /**
                 *  OTP is vaild and the account has been activated.
                 *
                 * @status 200
                 * @body array{status: true, message: 'your Account has been activated'}
                 */
                return response()->json([
                    "status" => true,
                    "message" => __('valid OTP Code'),
                ], 200);

            }

            /**
             *  Sorry OTP is not vaild or expired you can generate new one by resend.
             *
             * @status 400
             * @body array{status: false, message: 'sorry this code is not valid or expired'}
             */
            return response()->json([
                "status" => false,
                "message" => __('sorry this code is not valid or expired'),
            ], 400);
        }

        /**
         *  There is not account releated to this email/phone.
         *
         * @status 404
         * @body array{status: false, message: 'user not found'}
         */
        return response()->json([
            "status" => false,
            "message" => __('user not found'),
        ], 404);
    }


    /**
     * Check OTP & Active Account.
     *
     * You can check OTP is vaild by use this API and active the user if it's vaild.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function otp(Request $request){
        $request->validate([
            config('tomato-crm.login_by') => 'required|string|max:255',
            'otp_code' => 'required|string|max:6',
        ]);

        $user = app(config('tomato-crm.model'))->where("username", $request->get(config('tomato-crm.login_by')))->first();

        if ($user) {
            if ((!empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                $user->otp_activated_at = Carbon::now();
                $user->otp_code = null;
                $user->is_active = true;
                $user->save();

//                AccountOTPCheck::dispatch(config('tomato-crm.model'), $checkIfEx->id);
                apply_filters('after_enter_otp', $user);

                /**
                 *  OTP is vaild and the account has been activated.
                 *
                 * @status 200
                 * @body array{status: true, message: 'your Account has been activated'}
                 */
                return response()->json([
                    "status" => true,
                    "message" => __('your Account has been activated'),
                ], 200);

            }

            /**
             *  Sorry OTP is not vaild or expired you can generate new one by resend.
             *
             * @status 400
             * @body array{status: false, message: 'sorry this code is not valid or expired'}
             */
            return response()->json([
                "status" => false,
                "message" => __('sorry this code is not valid or expired'),
            ], 400);
        }

        /**
         *  There is not account releated to this email/phone.
         *
         * @status 404
         * @body array{status: false, message: 'user not found'}
         */
        return response()->json([
            "status" => false,
            "message" => __('user not found'),
        ], 404);
    }

    /**
     * Reset Password.
     *
     * You can send reset password request by use this APIs.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function reset(Request $request): JsonResponse
    {
        $request->validate([
            config('tomato-crm.login_by') => "required|exists:".app(config('tomato-crm.model'))->getTable().",username",
        ]);

        $checkIfActive = config('tomato-crm.model')::where("username", $request->get(config('tomato-crm.login_by')))->first();
        if ($checkIfActive) {
            $checkIfActive->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $checkIfActive->save();

            SendOTP::dispatch(config('tomato-crm.model'), $checkIfActive->id);

            /*
             *  OTP Send Success Using Service Provider.
             *  @status 200
             *  @body array{status: true, message: 'An OTP Has been send to your email please check it'}
             */
            return response()->json([
                "status" => true,
                "message" => 'An OTP Has been send to your '.$this->loginType . ' please check it'
            ], 200);
        }

        /*
         *  Sorry User Not Found!.
         *  @status 404
         *  @body array{status: false, message: 'user not found'}
         */
        return response()->json([
            "status" => false,
            "message" => __('user not found')
        ], 404);
    }

    /**
     * Change Password.
     *
     * If the request of change password has been send success you can change the password with OTP form here.
     *
     * @tags Auth
     * @param Request $request
     * @return JsonResponse
     */
    public function password(Request $request): JsonResponse
    {
        $user = $request->user();

        if($user){
            $request->validate([
                'password' => "required|confirmed|min:6|max:191",
            ]);

            $user->password = bcrypt($request->get('password'));
            $user->save();

            /*
              *  If Your Has Token He Can change the password direct without OTP.
              *  @status 200
              *  @body array{status: true, message: "Password Updated"}
              */
            return response()->json([
                "status"=> true,
                "message"=> __("Password Updated")
            ], 200);
        }
        else {
            $request->validate([
                'password' => "required|confirmed|min:6|max:191",
                'otp_code' => 'required|string|max:6|exists:'.app(config('tomato-crm.model'))->getTable().',otp_code',
                config('tomato-crm.login_by') => 'required|string|max:255|exists:'.app(config('tomato-crm.model'))->getTable().',username',
            ]);

            $user = app(config('tomato-crm.model'))->where("username", $request->get(config('tomato-crm.login_by')))->first();

            if ($user) {
                if ((!empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                    $user->otp_activated_at = Carbon::now();
                    $user->otp_code = null;
                    $user->password = bcrypt($request->get('password'));
                    $user->save();

                    /*
                      *  OTP is vaild and the password has been changed.
                      *  @status 200
                      *  @body array{status: true, message: "Password Updated"}
                      */
                    return response()->json([
                        "status"=> true,
                        "message"=> __("Password Updated")
                    ], 200);
                }

                /*
                  *  OTP is not vaild or expired please resend it.
                  *  @status 400
                  *  @body array{status: false, message: "sorry this code is not valid or expired"}
                  */
                return response()->json([
                    "status"=> true,
                    "message"=> __('sorry this code is not valid or expired')
                ], 400);
            }

            /*
              *  Sorry User Not Found!.
              *  @status 404
              *  @body array{status: false, message: 'user not found'}
              */
            return response()->json([
                "status" => false,
                "message" => __('user not found')
            ], 404);
        }
    }
}
