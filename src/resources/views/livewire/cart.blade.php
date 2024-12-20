<div class="mt-12 grid grid-cols-4 gap-4">

    <div class="bg-white rounded-lg shadow p-6 col-span-3 grid">
        <table class="col-3">
            <thead>
                <tr>
                    <th class="text-left">Product</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Variant</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->items as $item)
                    <tr>
                        <td>{{ $item->variant->product->name }}</td>
                        <td>{{ $item->variant->product->price }}</td>
                        <td>{{ $item->variant->size }} / {{ $item->variant->color }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->subTotal }}</td>
                        <td class="flex items-center">
    
                            <button wire:click='increment({{ $item->id }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                </svg>                              
                            </button>
    
                            <button wire:click='decrement({{ $item->id }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                              
    
                            <button wire:click='delete({{ $item->id }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>                              
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right font-medium">Total</td>
                    <td>{{ $this->total }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        @guest
            <p>You need to <a class="underline" href={{ route('register') }}>register</a> or <a class="underline" href={{ route('login') }}>login</a> to buy things.</p>
        @endguest
        @auth
            <div class="flex items-center justify-center h-full">
                <x-button class="h-8 text-center" wire:click='checkout'>Purchase</x-button>
            </div>
        @endauth
    </div>
</div>


