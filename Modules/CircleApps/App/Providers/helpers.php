<?php

if(!function_exists('has_app')) {
    function has_app(string $key): bool
    {
        if(auth('accounts')->user()){
            $hasApp = auth('accounts')->user()->apps()->where('key', $key)->first();
            if($hasApp){
                return  true;
            }
        }

        return false;
    }
}
