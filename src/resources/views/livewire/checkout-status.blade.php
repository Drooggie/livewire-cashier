<div class="bg-white rounded-md mt-12 p-6 shadow-md max-w-xl mx-auto">
    @if ($this->order)
        Thank You for your order! (#{{ $this->order->id }})
    @else
        <div wire:poll>
            Waiting for Order confirmation, wait please...
        </div>
    @endif
</div>
