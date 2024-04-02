<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Modules\TomatoCrm\App\Events\AccountRegistered;
use Modules\TomatoCrm\App\Events\SendOTP;
use Modules\TomatoCrm\App\Models\AccountsMeta;
use ProtoneMedia\Splade\Facades\Toast;

class AuthController extends Controller
{

    public function broadcasting(Request $request)
    {
        dd($request->all());
    }
    public function provider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        }catch (\Exception $exception){
            Toast::danger('Something went wrong!')->autoDismiss(2);
            return redirect()->route('account.login');
        }
    }

    public function callback($provider)
    {
        try {
            $providerHasToken = config('services.'.$provider.'.client_token');
            if($providerHasToken){
                $socialUser = Socialite::driver($provider)->userFromToken($providerHasToken);
            }
            else {
                $socialUser = Socialite::driver($provider)->user();
            }

            if(auth('accounts')->user()){
                AccountsMeta::where('key', $provider . '_id')->where('value', $socialUser->id)->delete();

                $account = auth('accounts')->user();
                $account->meta($provider . '_id', $socialUser->id);
                if ($socialUser->token) {
                    $account->meta($provider . '_token', $socialUser->token);
                }
                if ($socialUser->refreshToken) {
                    $account->meta($provider . '_refresh_token', $socialUser->refreshToken);
                }

                if (isset($socialUser->attributes['avatar']) && !$account->getMedia('avatar')->first()) {
                    $account->addMediaFromUrl($socialUser->attributes['avatar'])->toMediaCollection('avatar');
                }

                Toast::success('Account connected successfully!')->autoDismiss(2);
                return redirect()->route('profile.index');
            }
            else {
                $findUserByProvider = Account::whereHas('accountsMetas', function ($q) use ($socialUser, $provider){
                    $q->where('key', $provider . "_id")->where('value', $socialUser->id);
                })->first();

                if($findUserByProvider){
                    if(isset($socialUser->attributes['avatar']) && !$findUserByProvider->getMedia('avatar')->first()){
                        $findUserByProvider->addMediaFromUrl($socialUser->attributes['avatar'])->toMediaCollection('avatar');
                    }
                    Toast::success('Account connected successfully!')->autoDismiss(2);

                    auth('accounts')->login($findUserByProvider);
                    return redirect()->route('profile.index');
                }
                else {
                    if($socialUser->email){
                        $findUserByEmail = Account::where('email', $socialUser->email)->first();
                        if($findUserByEmail){
                            $findUserByEmail->meta($provider . '_id', $socialUser->id);
                            if ($socialUser->token) {
                                $findUserByEmail->meta($provider . '_token', $socialUser->token);
                            }
                            if ($socialUser->refreshToken) {
                                $findUserByEmail->meta($provider . '_refresh_token', $socialUser->refreshToken);
                            }

                            if (isset($socialUser->attributes['avatar']) && !$findUserByEmail->getMedia('avatar')->first()) {
                                $findUserByEmail->addMediaFromUrl($socialUser->attributes['avatar'])->toMediaCollection('avatar');
                            }

                            Toast::success('Account connected successfully!')->autoDismiss(2);

                            auth('accounts')->login($findUserByEmail);
                            return redirect()->route('profile.index');
                        }
                        else {
                            $account = new Account();
                            $account->name = $socialUser->name;
                            $account->email = $socialUser->email;
                            if(isset($socialUser->attributes['nickname'])){
                                $username = $socialUser->attributes['nickname'];
                            }
                            else {
                                $username = str($socialUser->name)->slug('_');
                            }
                            $checkIfUserNameExists = Account::where('username', "@" . $username)->first();
                            if($checkIfUserNameExists){
                                $username = $username . rand(1000, 9999);
                            }

                            $account->username = "@" . $username;
                            $account->is_active = true;
                            $account->save();

                            $account->meta($provider . '_id', $socialUser->id);
                            if($socialUser->token){
                                $account->meta($provider . '_token', $socialUser->token);
                            }
                            if($socialUser->refreshToken){
                                $account->meta($provider . '_refresh_token', $socialUser->refreshToken);
                            }

                            if(isset($socialUser->attributes['avatar'])){
                                $account->addMediaFromUrl($socialUser->attributes['avatar'])->toMediaCollection('avatar');
                            }

                            Toast::success('Account connected successfully!')->autoDismiss(2);

                            auth('accounts')->login($account);
                            return redirect()->route('profile.index');
                        }
                    }
                    else {
                        $account = new Account();
                        $account->name = $socialUser->name;
                        $account->email = $socialUser->email;
                        if(isset($socialUser->attributes['nickname'])){
                            $username = $socialUser->attributes['nickname'];
                        }
                        else {
                            $username = str($socialUser->name)->slug('_');
                        }
                        $checkIfUserNameExists = Account::where('username', "@" . $username)->first();
                        if($checkIfUserNameExists){
                            $username = $username . rand(1000, 9999);
                        }

                        $account->username = "@" . $username;
                        $account->is_active = true;
                        $account->save();

                        $account->meta($provider . '_id', $socialUser->id);
                        if($socialUser->token){
                            $account->meta($provider . '_token', $socialUser->token);
                        }
                        if($socialUser->refreshToken){
                            $account->meta($provider . '_refresh_token', $socialUser->refreshToken);
                        }

                        if(isset($socialUser->attributes['avatar'])){
                            $account->addMediaFromUrl($socialUser->attributes['avatar'])->toMediaCollection('avatar');
                        }

                        Toast::success('Account connected successfully!')->autoDismiss(2);
                        auth('accounts')->login($account);
                        return redirect()->route('profile.index');
                    }
                }
            }
        }
        catch (\Exception $exception){
            Toast::danger('Something went wrong!')->autoDismiss(2);
            return redirect()->route('account.login');
        }
    }

    public function register()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|regex:/\w*$/|unique:accounts',
            'email' => 'required|string|email|max:255|unique:accounts',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->merge([
            "username" => "@" . strtolower($request->username),
            "otp_code" => rand(100000, 999999),
            "password" => bcrypt($request->password),
        ]);

        $account = Account::create($request->all());

        SendOTP::dispatch(Account::class, $account->id);
        AccountRegistered::dispatch(Account::class, $account->id);


        if (Session::has('email')){
            Session::forget('email');
        }

        Session::put('email', $request->email);

        try {
            $user = User::first();
            $user->notifyDiscord(
                title: "=========== New CircleXO User =========== \n".' NAME: '.$account->name . " \n EMAIL: " . $account->email . " \n USERNAME: " . $account->username ,
                webhook: config('services.discord.notification-webhook')
            );
        }catch (\Exception $exception){
            // do nothing
        }


        Toast::success('Account created successfully!')->autoDismiss(2);
        return redirect()->route('account.otp');
    }

    public function resend()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        if (Session::has('email')){
            $account = Account::where('email', Session::get('email'))->first();
            if($account){
                $account->update([
                    "otp_code" => rand(100000, 999999)
                ]);

                SendOTP::dispatch(Account::class, $account->id);
                AccountRegistered::dispatch(Account::class, $account->id);

                Toast::success('OTP code sent successfully!')->autoDismiss(2);
                return redirect()->back();
            }
            else
            {
                return redirect()->route('account.register');
            }
        }
        else
        {
            return redirect()->route('account.register');
        }
    }

    public function login()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.login');
    }

    public function check(Request $request)
    {
        $request->merge([
            "username" => "@" . strtolower($request->username),
        ]);

        $request->validate([
            'username' => 'required|string|max:255|exists:accounts,username',
            'password' => 'required|string|min:8',
        ]);

        $user = auth('accounts')->attempt($request->only('username', 'password'));
        if($user){
            Toast::success('Logged in successfully!')->autoDismiss(2);
            return redirect()->route('profile.index');
        }

        Toast::danger('Invalid credentials!')->autoDismiss(2);
        return redirect()->back();

    }

    public function reset()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        return view('circle-xo::auth.reset');
    }

    public function email(Request $request)
    {
        $request->validate([
           "email" => "required|string|email|max:255|exists:accounts,email"
        ]);

        $account = Account::where('email', $request->get('email'))->first();

        if($account){
            $account->update([
                "otp_code" => rand(100000, 999999)
            ]);

            SendOTP::dispatch(Account::class, $account->id);
            AccountRegistered::dispatch(Account::class, $account->id);

            if (Session::has('email')){
                Session::forget('email');
            }

            Session::put('email', $account->email);

            Toast::success('OTP code sent successfully!')->autoDismiss(2);
            return redirect()->route('account.password');
        }
        else {
            Toast::danger('Invalid email!')->autoDismiss(2);
            return redirect()->back();
        }
    }

    public function password()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        if (Session::has('email')){
            return view('circle-xo::auth.password');
        }
        else
        {
            return redirect()->route('account.register');
        }
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|max:6|exists:accounts,otp_code',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $account = Account::where('email', Session::get('email'))->first();

        if ($account->otp_code == $request->otp_code){
            $account->otp_activated_at = Carbon::now();
            $account->otp_code = null;
            $account->password = bcrypt($request->get('password'));
            $account->save();

            Session::forget('email');

            Toast::success('Account password has been reset successfully!')->autoDismiss(2);
            return redirect()->route('account.login');
        }
        else
        {
            Toast::danger('Invalid OTP code!')->autoDismiss(2);
            return redirect()->back();
        }
    }

    public function otp()
    {
        if(auth('accounts')->user()){
            return redirect()->route('profile.index');
        }

        if (Session::has('email')){
            return view('circle-xo::auth.otp');
        }
        else
        {
            return redirect()->route('account.register');
        }
    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|max:6|exists:accounts,otp_code',
        ]);

        $account = Account::where('email', Session::get('email'))->first();

        if ($account->otp_code == $request->otp_code){
            $account->otp_activated_at = Carbon::now();
            $account->otp_code = null;
            $account->is_active = true;
            $account->save();

            Session::forget('email');

            Toast::success('Account activated successfully!')->autoDismiss(2);
            return redirect()->route('account.login');
        }
        else
        {
            Toast::danger('Invalid OTP code!')->autoDismiss(2);
            return redirect()->back();
        }
    }
}
