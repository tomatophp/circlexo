<?php

use Illuminate\Support\Facades\Crypt;

if(!function_exists('is_developer')){
    function is_developer(): bool
    {
        return session()->get('dev_password') && (Crypt::decrypt(session()->get('dev_password')) === config('tomato-roles.developer_password'));
    }
}
if(!function_exists('developer_redirect')){
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function developer_redirect(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('tomato-roles::developer.password');
    }
}

