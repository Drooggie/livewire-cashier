<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderPreview extends Component
{
    public Order $order;

    public function mount(
        Order $order
    ) {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.order-preview');
    }
}
