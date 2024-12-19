<?php

namespace App\Livewire;

use App\Actions\Webshop\CheckoutThrowStripe;
use App\Factories\CartFactory;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Cart extends Component
{
    use InteractsWithBanner;

    protected $listeners = [
        'totalAmountUpdated' => '$refresh'
    ];

    public function checkout(CheckoutThrowStripe $cashier)
    {
        return $cashier->checkout($this->cart);
    }

    public function getCartProperty()
    {
        return CartFactory::make()->loadMissing(['items', 'items.variant', 'items.variant.product']);
    }

    public function getItemsProperty()
    {
        return $this->cart->items()->latest()->get();
    }

    public function getTotalProperty()
    {
        return $this->cart->total;
    }

    public function increment($itemId)
    {
        $this->items->find($itemId)->increment('quantity');

        $this->dispatch('totalAmountUpdated');
        $this->dispatch('productAdded');
    }

    public function decrement($itemId)
    {
        $item = $this->items->find($itemId);

        $item->decrement('quantity');
        $itemQuantity = $item->quantity;

        if ($itemQuantity === 0) {
            $item->delete();
        }

        $this->dispatch('totalAmountUpdated');
        $this->dispatch('ItemDeleted');
    }

    public function delete($itemId)
    {
        $cartItem = $this->cart->items();

        $cartItem->findOrFail($itemId)->delete();

        $this->dispatch('ItemDeleted');
        $this->banner('Cart item was deleted');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
