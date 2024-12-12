<div class="grid grid-cols-4 gap-4 mt-4">
    @foreach ($this->products as $product)
        <div class="bg-white p-4 rounded-xl shadow-xl relative">
            <a href="{{ route('product', $product) }}" class="absolute inset-0 w-full h-full"></a>
            <img src="{{ url($product->image->path) }}" alt="">
            <h2 class="font-medium text-lg">
                {{ $product->name }}
            </h2>
            <span>{{ $product->price }}</span>
        </div>
    @endforeach
</div>
