<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutStatus extends Component
{
    public $sessionId;

    public function mount(Request $request)
    {
        $this->sessionId = $request->get('session_id');
    }

    public function getOrderProperty()
    {
        return Auth::user()->orders()->where('stripe_checkout_session_id', $this->sessionId)->first();
    }

    public function render()
    {
        return view('livewire.checkout-status');
    }
}
