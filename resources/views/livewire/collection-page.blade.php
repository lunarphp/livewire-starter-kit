<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>

        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($this->collection->products as $product)
                <a
                    class="block group"
                    href="{{ route('product.view', $product->defaultUrl->slug) }}"
                >
                    <div class="overflow-hidden rounded-lg aspect-w-1 aspect-h-1">
                        @if ($product->thumbnail)
                            <img
                                class="object-cover transition-transform duration-300 group-hover:scale-105"
                                src="{{ $product->thumbnail->getUrl('medium') }}"
                                alt="{{ $product->translateAttribute('name') }}"
                                loading="lazy"
                            />
                        @endif
                    </div>

                    <h5 class="mt-2 font-medium">
                        {{ $product->translateAttribute('name') }}
                    </h5>

                    <p class="mt-1 text-sm text-gray-600">
                        <span class="sr-only">
                            Price
                        </span>

                        <x-product-price :product="$product" />
                    </p>
                </a>
            @empty
            @endforelse
        </div>
    </div>
</section>
