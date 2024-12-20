<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CheckoutThrowStripe
{
    public function checkout(Cart $cart)
    {
        $lineitems = $this->formatFromCart($cart->items);

        if (!$lineitems) {
            return redirect()->route('home')
                ->with('error', 'Your cart is empty. Please choose product and process payment process.');
        }

        return $cart->user->allowPromotionCodes()->checkout(
            $lineitems,
            [
                'customer_update' => [
                    'shipping' => 'auto',
                ],
                'shipping_address_collection' => [
                    'allowed_countries' => [
                        'US',
                        'NL',
                        'KZ'
                    ],
                ],
                'success_url' => route('checkout-status') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart'),
                'metadata' => [
                    'user_id' => $cart->user->id,
                    'cart_id' => $cart->id,
                ],
            ]
        );
    }

    public function formatFromCart(Collection $items)
    {
        return $items->loadMissing('variant', 'variant.product')->map(function (CartItem $item) {
            return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item->variant->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->variant->product->name,
                        'description' => "size:" . $item->variant->size . " / color: " . $item->variant->color,
                        'metadata' => [
                            'product_id' => $item->variant->product->id,
                            'product_variant_id' => $item->variant->id,
                        ]
                    ]
                ],

                'quantity' => $item->quantity,
            ];
        })->toArray();
    }
}
