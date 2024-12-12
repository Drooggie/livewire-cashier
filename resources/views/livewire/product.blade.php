<div class="grid grid-cols-2 gap-10 mt-10">

    <div class="space-y-4" x-data="{image: '{{Storage::url($product->image->path)}}'}">
        <div class="bg-white p-4 rounded-xl shadow-xl">
            <img x-bind:src="image" alt="">
        </div>
    
        <div class="grid grid-cols-4 gap-4">
            @foreach ($product->images as $image)
                <div class="bg-white p-2 rounded-md shadow-md">
                    <img @click="image = '{{Storage::url($image->path)}}'" src="{{Storage::url($image->path)}}" alt="">
                </div>
            @endforeach
        </div>
    </div>

    <div class="">
        <h1 class="font-medium text-5xl">
            {{$product->name}}
        </h1>
        <span class="text-xl text-gray-700">
            {{$product->price}}
        </span>

        <div class="mt-4">
            {{ $product->description }}
        </div>

        <div class="my-4">
            <select wire:model='variant' class="block w-full rounded-md shadow-md border-none">
                @foreach ($product->variants as $variant)
                    <option value="{{ $variant->id }}">
                        {{ $variant->color }} / {{ $variant->size }}
                    </option>
                @endforeach
            </select>

            @error('variant')
                <div class="my-2 text-red-600">{{ $message }}</div>
            @enderror

            <p>{{ $product->variants->find($variant)->color }}</p>

        </div>

        <x-button wire:click="addToCart">Add to Cart</x-button>

    </div>

</div>