<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use App\Models\Cart as ModelsCart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Cart extends Component
{
    use InteractsWithBanner;

    public $cartId;

    public function make(ModelsCart $cart) {}

    public function getItemsProperty()
    {
        return CartFactory::make()->items()->with('variant.product')->latest()->get();
    }

    public function delete($itemId)
    {
        $cartItem = CartFactory::make()->items();

        $cartItem->findOrFail($itemId)->delete();

        $this->dispatch('ItemDeleted');
        $this->banner('Cart item was deleted');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
