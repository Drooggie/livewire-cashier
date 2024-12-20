<?php

namespace App\Actions\Webshop;

use App\Mail\SendOrderConfirmation;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;
use Stripe\LineItem;

class HandleCheckoutSessionCompleted
{
    public function handle($sessionId)
    {
        DB::transaction(function () use ($sessionId) {
            $sessions = Cashier::stripe()->checkout->sessions;
            $retrived = $sessions->retrieve($sessionId);

            $user = User::find($retrived->metadata->user_id);
            $cart = Cart::find($retrived->metadata->cart_id);

            $total_details = $retrived->total_details;
            $customer_details = $retrived->customer_details;
            $shipping_details = $retrived->shipping_details;

            $order = $user->orders()->create([
                'user_id'                    => $user->id,
                'stripe_checkout_session_id' => $retrived->id,
                'amount_shipping'            => $total_details->amount_shipping,
                'amount_discount'            => $total_details->amount_discount,
                'amount_tax'                 => $total_details->amount_tax,
                'amount_subtotal'            => $retrived->amount_subtotal,
                'amount_total'               => $retrived->amount_total,
                'billing_address'            => [
                    'name'        => $customer_details->name,
                    'city'        => $customer_details->address->city,
                    'country'     => $customer_details->address->country,
                    'line1'       => $customer_details->address->line1,
                    'line2'       => $customer_details->address->line2,
                    'postal_code' => $customer_details->address->postal_code,
                    'state'       => $customer_details->address->state,
                ],
                'shipping_address'           => [
                    'name'        => $shipping_details->name,
                    'city'        => $shipping_details->address->city,
                    'country'     => $shipping_details->address->country,
                    'line1'       => $shipping_details->address->line1,
                    'line2'       => $shipping_details->address->line2,
                    'postal_code' => $shipping_details->address->postal_code,
                    'state'       => $shipping_details->address->state,
                ],
            ]);

            $lineItems = $sessions->allLineItems($retrived->id);

            $orderItems = collect($lineItems->all())->map(function (LineItem $line) {
                $product = Cashier::stripe()->products->retrieve($line->price->product);

                return new OrderItem([
                    'product_variant_id' => $product->metadata->product_variant_id,
                    'name'               => $product->name,
                    'description'        => $product->description,
                    'price'              => $line->price->unit_amount,
                    'quantity'           => $line->quantity,
                    'amount_discount'    => $line->amount_discount,
                    'amount_tax'         => $line->amount_tax,
                    'amount_subtotal'    => $line->amount_subtotal,
                    'amount_total'       => $line->amount_total,
                ]);
            });

            $order->items()->saveMany($orderItems);

            $cart->items()->delete();
            $cart->delete();

            Mail::to($user->email)->queue(new SendOrderConfirmation($order));
        });
    }
}
