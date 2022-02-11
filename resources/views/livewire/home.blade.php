<x-welcome-banner />

<div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    @if ($this->saleCollection)
        <a
            class="relative block"
            href="{{ route('collection.view', $this->saleCollection->defaultUrl->slug) }}"
        >
            <figure>
                <img src="{{ $this->saleCollection->thumbnail->getUrl() }}" />
            </figure>

            <div class="absolute bottom-0 p-6 text-white">
                <strong class="text-6xl shadow">
                    {{ $this->saleCollection->translateAttribute('name') }}
                </strong>

                <p class="text-xl shadow">
                    {{ $this->saleCollection->translateAttribute('description') }}
                </p>
            </div>
        </a>
    @endif

    @if ($this->randomCollection)
        <section>
            <h2 class="text-3xl font-bold">
                {{ $this->randomCollection->translateAttribute('name') }}
            </h2>

            <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-4 gap-y-8">
                @foreach ($this->randomCollection->products as $product)
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

                        <h5 class="mt-2 text-sm font-medium">
                            {{ $product->translateAttribute('name') }}
                        </h5>

                        <p class="mt-1 text-sm text-gray-600">
                            <span class="sr-only">
                                Price
                            </span>

                            <x-product-price :product="$product" />
                        </p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
