<?php

namespace Modules\TomatoEcommerce\App\Services;

use Modules\TomatoEcommerce\App\Models\Cart;
use Modules\TomatoEcommerce\App\Services\Traits\StoreCart;
use Modules\TomatoEcommerce\App\Services\Traits\UpdateQTY;

class Ecommerce
{
    use StoreCart;
    use UpdateQTY;

    private Cart $cart;

    public function setCart(Cart $cart): static
    {
        $this->cart = $cart;
        return $this;
    }
}
