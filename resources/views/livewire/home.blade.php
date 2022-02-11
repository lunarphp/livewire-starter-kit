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
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif
</div>
