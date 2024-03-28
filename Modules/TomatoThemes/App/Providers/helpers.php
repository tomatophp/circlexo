<?php

use Illuminate\Support\Facades\File;

if(!function_exists('theme_assets')) {
    /**
     * @param string|null $path
     * @return string
     */
    function theme_assets(string $path = null): string
    {
        return asset('storage/themes/' . setting('theme_name') . '/' . $path);
    }
}

if(!function_exists('theme_setting')) {
    /**
     * @param string $key
     * @return mixed
     */
    function theme_setting(string $key): mixed
    {
        if(!File::exists(base_path('Themes'))){
            return false;
        }
        if(!File::exists(base_path('Themes') .'/'.setting('theme_path')) ){
            return false;
        }
        $info = json_decode(File::get(base_path('Themes').'/'.setting('theme_path') . "/info.json"), false);
        if(isset($info->settings->{$key})){
            return $info->settings->{$key}->value;
        }

        $settingClass = new \Modules\TomatoSettings\App\Settings\ThemesSettings();

        if(isset($settingClass->{'theme_'.$key})){
            return $settingClass->{'theme_'.$key};
        }

        return false;
    }
}

if(!function_exists('wishlist')){
    function wishlist(int $product_id): bool
    {
        if(auth('accounts')->user()){
            $wishlist = \Modules\TomatoEcommerce\App\Models\Wishlist::where('account_id', auth('accounts')->user()->id)
                ->where('product_id', $product_id)->first();

            if($wishlist){
                return true;
            }
        }

        return false;
    }
}
