<?php

namespace App\Actions\Webshop;

use App\Models\Cart;

class MigrateCartItems
{
    public function migrate(Cart $sessionCart, Cart $userCart)
    {
        $sessionCart->items->each(fn($item) => (new AddProductVariantToCart)->add(
            variantId: $item->product_variant_id,
            quantity: $item->quantity,
            userCart: $userCart
        ));
    }
}
