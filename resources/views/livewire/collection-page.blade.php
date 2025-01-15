<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">
            {{ $this->collection->attr('name') }}
        </h1>

        <div class="grid grid-cols-12 gap-12">
            <div class="col-span-3 space-y-2">
                @include('partials.search.search-filters')
            </div>
            <div class="col-span-9">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->results->hits as $result)
                        <div>
                            <x-product-card
                                :thumbnail="$result->document['thumbnail']"
                                :name="$result->document['name']"
                                :slug="$result->document['slug']"
                                :price="$result->document['price']['ex_tax']['formatted']"
                            ></x-product-card>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
