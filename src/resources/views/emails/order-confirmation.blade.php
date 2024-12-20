@component('mail::message')
Hey {{ $order->user->name }}

Thank you for your order! You can find all details below.

<table style="width:100%;">
    <thead>
        <tr>
            <td>name</td>
            <td>description</td>
            <td>price</td>
            <td>tax</td>
            <td>quantity</td>
            <td>total</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->amount_tax }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->amount_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@component('mail::button', ['url' => route('order-preview', $order->id)])
    View Order
@endcomponent

@endcomponent