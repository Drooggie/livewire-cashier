<x-nav-link href="{{ route('cart') }}" :active="request()->routeIs('cart')">
    {{ __("Cart Items ($this->count)")}}
</x-nav-link>