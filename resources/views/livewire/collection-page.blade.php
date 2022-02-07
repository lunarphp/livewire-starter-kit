<div>
    <section>
        <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-xl font-bold sm:text-3xl">
                    {{ $this->collection->translateAttribute('name') }}
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-8 lg:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($this->collection->products as $product)
                <a
                    href="{{ route('product.view', $product->defaultUrl->slug) }}"
                    class="block"
                >
                    <div class="aspect-w-1 aspect-h-1">
                        @if($product->thumbnail)
                            <img
                                loading="lazy"
                                alt="Bamboo Toothbrush"
                                class="object-cover rounded"
                                src="{{ $product->thumbnail->getUrl('medium') }}"
                            />
                        @endif
                    </div>

                    <h5 class="mt-2 text-lg font-medium">
                        {{ $product->translateAttribute('name') }}
                    </h5>

                    <p class="text-sm text-gray-700">
                        <x-product-price :product="$product" />
                    </p>
                </a>
            @empty
            @endforelse
            </div>
        </div>
    </section>
</div>
