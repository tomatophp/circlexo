<?php

namespace Modules\TomatoEcommerce\App\Services\Traits;

use Modules\TomatoEcommerce\App\Models\Cart;
use Modules\TomatoEcommerce\App\Models\Wishlist;
use Modules\TomatoProducts\App\Models\ProductReview;

trait InteractsWithEcommerce
{
    public function reviews(){
        return $this->hasMany(ProductReview::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
