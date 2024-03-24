<?php

namespace Modules\TomatoCrm\App\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Modules\TomatoCrm\App\Services\Contracts\WebResponse;

/**
 * @method static guard(string $guard)
 * @method static requiredOtp(bool $otp)
 * @method static model(string $model)
 * @method static loginBy(string $loginBy)
 * @method static loginType(string $loginType)
 * @method static resource(string $resource)
 * @method static createValidation(array $createValidation)
 * @method static updateValidation(array $updateValidation)
 * @method \Illuminate\Http\JsonResponse|WebResponse login(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse logout(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse otp(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse register(\Illuminate\Http\Request $request, array $validation=[], string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse reset(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse password(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse resend(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse profile(\Illuminate\Http\Request $request, string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse update(\Illuminate\Http\Request $request, array $validation=[], string $type = "api")
 * @method \Illuminate\Http\JsonResponse|WebResponse destroy(\Illuminate\Http\Request $request, string $type = "api")
 */
class TomatoAuth extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'tomato-auth';
    }
}
