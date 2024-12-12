<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Models\Image;
use App\Models\Product as ModelsProduct;
use App\Models\ProductVariant;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Product extends Component
{
    use InteractsWithBanner;

    public $product;
    public $variant;

    public $rules = [
        'variant' => 'required|exists:product_variants,id',
    ];

    public function mount(ModelsProduct $product)
    {
        $this->product = $product;
        $this->variant = $this->product->variants->first()->id;
    }

    public function addToCart(AddProductVariantToCart $cart)
    {
        $this->validate();

        $cart->add(variantId: $this->variant);

        $this->banner('Your item have been added to cart.');
        $this->dispatch('ProductAdded');
    }

    public function render()
    {
        return view('livewire.product');
    }
}
