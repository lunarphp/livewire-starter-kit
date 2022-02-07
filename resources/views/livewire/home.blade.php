<div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    @if($this->saleCollection)
    <a class="relative block" href="{{ route('collection.view', $this->saleCollection->defaultUrl->slug) }}">
        <figure>
            <img src="{{ $this->saleCollection->thumbnail->getUrl() }}" />
        </figure>
        <div class="absolute bottom-0 p-6 text-white">
            <strong class="text-6xl shadow">{{ $this->saleCollection->translateAttribute('name') }}</strong>
            <p class="text-xl shadow">{{ $this->saleCollection->translateAttribute('description') }}</p>
        </div>
    </a>
    @endif

    @if($this->randomCollection)
        <section>
            <div class="max-w-screen-xl px-4 py-8 mx-auto">
                <div>
                    <span class="inline-block w-12 h-1 bg-red-700"></span>

                    <h2 class="mt-1 text-2xl font-extrabold tracking-wide uppercase lg:text-3xl">
                        {{ $this->randomCollection->translateAttribute('name') }}
                    </h2>
                </div>
                <div class="grid grid-cols-2 mt-8 lg:grid-cols-4 gap-x-4 gap-y-8">
                    @foreach ($this->randomCollection->products as $product)
                        <a href="{{ route('product.view', $product->defaultUrl->slug) }}" class="block">
                            @if($product->thumbnail)
                                <img
                                    loading="lazy"
                                    class="object-cover w-full -mt-3 h-96"
                                    src="{{ $product->thumbnail->getUrl('medium') }}"
                                />
                            @endif

                            <h5 class="mt-4 text-sm text-black/90">
                                {{ $product->translateAttribute('name') }}
                            </h5>

                            <div class="flex items-center justify-between mt-4 font-bold">
                                <p class="text-lg">
                                    <x-product-price :product="$product" />
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
