<?php

if(!function_exists('has_app')) {
    function has_app(string $key, ?int $account=null): bool
    {
        if(auth('accounts')->user()){
            $hasApp = auth('accounts')->user()->apps()->where('key', $key)->first();
            if($hasApp){
                if($account){
                    if($account == auth('accounts')->user()->id){
                        return true;
                    }
                    else {
                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }
}
