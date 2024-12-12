<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddProductVariantToCart
{
    public $variantId;

    public function add($variantId)
    {
        $this->variantId = $variantId;

        $cart = CartFactory::make();

        $cart->items()->FirstOrCreate(
            ['product_variant_id' => $variantId],
            ['quantity' => 0]
        )->increment('quantity');
    }
}
