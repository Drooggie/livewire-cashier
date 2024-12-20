@component('mail::message')
Hey {{ $cart->user->name }}

You have products that you abandoned in the cart.

<table style="width:100%;">
    <thead>
        <tr>
            <td>name</td>
            <td>description</td>
            <td>price</td>
            <td>quantity</td>
            <td>subtotal</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart->items as $item)
            <tr>
                <td>{{ $item->variant->product->name }}</td>
                <td>{{ $item->variant->product->description }}</td>
                <td>{{ $item->variant->product->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                {{ $cart->total }}
            </td>
        </tr>
    </tfoot>
</table>

@component('mail::button', ['url' => route('cart')])
    View Cart
@endcomponent

@endcomponent