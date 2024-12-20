<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddProductVariantToCart
{

    public function add($variantId, $quantity = 0, $userCart = null)
    {
        $cart = $userCart ?: CartFactory::make();

        $items = $cart->items()->FirstOrCreate(
            ['product_variant_id' => $variantId],
            ['quantity' => $quantity]
        );

        $items->increment('quantity');
        $items->touch();
    }
}
