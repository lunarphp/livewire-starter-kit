@props(['product'])

<a class="group relative"
   href="{{ route('product.view', $product->defaultUrl->slug) }}"
   wire:navigate
>
    <div class="overflow-hidden rounded-lg">
        @if ($product->thumbnail)
            <img class="object-cover transition-transform duration-300 group-hover:scale-105"
                 src="{{ $product->thumbnail->getUrl('medium') }}"
                 alt="{{ $product->translateAttribute('name') }}" />
            <x-flag :text="$product->discount()?->name" />
        @endif
        <!-- Out of Stock Overlay -->
        @if (!$product->isAvailable())
            <div class="absolute inset-0 rounded-lg flex items-center justify-center bg-black bg-opacity-50 text-white text-lg font-semibold">
                Out of Stock
            </div>
        @endif
    </div>

    <div class="mt-1 flex justify-between">
    <div>
        <h3 class="text-sm text-gray-700">{{ $product->brand->name }}</h3>
        <h3 class="mt-1 text-sm font-medium">{{ $product->translateAttribute('name') }}</h3>
    </div>

    <x-product-price class="text-right" :product="$product" />
    </div>
</a>
