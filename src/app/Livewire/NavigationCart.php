<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;

class NavigationCart extends Component
{
    protected $listeners = [
        'ProductAdded' => '$refresh',
        'ItemDeleted' => '$refresh',
    ];

    public function getCountProperty()
    {
        return CartFactory::make()->items()->sum('quantity');
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}
