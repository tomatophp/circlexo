<?php

namespace Modules\TomatoCrm\App\Services;

use Spatie\Macroable\Macroable;
use Modules\TomatoCrm\App\Services\Traits\Auth\Login;
use Modules\TomatoCrm\App\Services\Traits\Auth\Otp;
use Modules\TomatoCrm\App\Services\Traits\Auth\ResetPassword;
use Modules\TomatoCrm\App\Services\Traits\Auth\Register;
use Modules\TomatoCrm\App\Services\Traits\Profile\Delete;
use Modules\TomatoCrm\App\Services\Traits\Profile\Logout;
use Modules\TomatoCrm\App\Services\Traits\Profile\Update;
use Modules\TomatoCrm\App\Services\Traits\Profile\User;

class BuildAuth
{
    use Login;
    use Otp;
    use ResetPassword;
    use Register;
    use Delete;
    use Logout;
    use Update;
    use User;
    use Macroable;

    public function __construct(
        /**
         * @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?string $guard='web',
        /**
         * @var bool|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?bool $otp=true,
        /**
         * @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?string $model="App\Models\User",
        /**
         * @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?string $loginBy='email',
        /**
         * @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?string $loginType='email',
        public ?string $resource=null,
        /**
         * @var array|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
         */
        public ?array $createValidation=[],
        public ?array $updateValidation=[],
    )
    {
    }

    public function guard(string $guard): static
    {
        $this->guard = $guard;
        return $this;
    }

    public function requiredOtp(bool $otp): static
    {
        $this->otp = $otp;
        return $this;
    }

    public function model(string $model): static
    {
        $this->model = $model;
        return $this;
    }

    public function loginBy(string $loginBy): static
    {
        $this->loginBy = $loginBy;
        return $this;
    }

    public function loginType(string $loginType): static
    {
        $this->loginType = $loginType;
        return $this;
    }

    public function resource(string $resource): static
    {
        $this->resource = $resource;
        return $this;
    }

    public function createValidation(array $createValidation): static
    {
        $this->createValidation = $createValidation;
        return $this;
    }

    public function updateValidation(array $updateValidationn): static
    {
        $this->updateValidation = $updateValidation;
        return $this;
    }
}
