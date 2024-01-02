<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->translateAttribute('name') }}
        </h1>
        <div class="grid grid-cols-1 gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        {{ $products->links('components.page') }}
    </div>
</section>
