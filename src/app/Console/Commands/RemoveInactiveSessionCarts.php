<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveInactiveSessionCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-inactive-session-carts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carts = Cart::whereDoesntHave('user')->whereDate('updated_at', '<', now()->subDay(1))->with('items')->get();

        $this->components->info($carts->count() . ' inactive carts removed');

        foreach ($carts as $cart) {
            $this->removeItems($cart);
            $cart->delete();
        }
    }

    public function removeItems($cart)
    {
        foreach ($cart->items as $item) {
            $item->delete();
        }
    }
}
