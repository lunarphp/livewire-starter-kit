<section>
    <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8 space-y-6">
        <header>
            <h1 class="text-3xl font-bold">
                @if(!empty($isCollection))
                    {{ $this->collection->attr('name') }}
                @elseif($this->query)
                    Search Results for "{{ $this->query }}"
                @else
                    All Products
                @endif
            </h1>
        </header>

        @if(!$this->results->count)
            <div>
                Sorry, looks like we don't have any products available.
            </div>
        @endif
        <div
            class="grid grid-cols-1 md:grid-cols-12 gap-12"
            x-data="{
               showFilters: false
            }"
        >
            <div
                class="md:col-span-3 space-y-2 fixed md:static md:overflow-y-auto bg-white w-full z-50 left-0 p-4 md:p-0 overflow-y-scroll h-full top-0"
                :class="{
                    'hidden md:block': !showFilters
                }"
            >
                <header class="flex items-center justify-between md:hidden">
                    Search Filters
                    <button type="button" @click="showFilters = false" class="border px-2 py-1 rounded text-xs font-medium shadow-sm">Close</button>
                </header>
                @include('partials.search.search-filters')
            </div>
            <div class="md:col-span-9 space-y-4">
                @if($this->results->count)
                <div class="md:flex md:space-x-2 space-y-2 md:space-y-0 justify-between">
                    <div class="w-2/5">
                        {{ $this->results->links }}
                    </div>
                    <div class="flex-shrink-0 flex md:flex-none items-center justify-between">
                        <div class="md:hidden">
                            <button @click="showFilters = true" class="border px-4 py-1 rounded" type="button">Filters</button>
                        </div>
                        <div>
                            @include('partials.search.sorting')
                        </div>
                    </div>
                </div>
                @endif
                <div class="grid grid-cols-2 gap-4 md:gap-8 lg:grid-cols-3">
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
