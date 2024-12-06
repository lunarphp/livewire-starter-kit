<section>
    <div class="max-w-screen-xl px-4 py-8 space-y-6 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-1 lg:grid-cols-6"
                @if ($this->image) x-data="{ active: @entangle('largeImageURL') }" @endif>
                @if ($this->image)
                    <div class="relative aspect-w-1 aspect-h-1 lg:col-span-5">
                        <img class="object-cover rounded-xl" x-bind:src="active"
                             alt="{{ $this->product->translateAttribute('name') }}" />
                        @if ($this->variant->canBeFulfilledAtQuantity(1))
                        <x-flag :text="$this->product->discount()?->name" />
                        @else 
                        <x-flag text="Sold out" />
                        @endif
                    </div>
                @endif

                <div class="grid grid-cols-2 content-start cursor-pointer gap-4 sm:grid-cols-4 lg:grid-cols-1">
                    @foreach ($this->images as $image)
                        <div class="aspect-w-1 aspect-h-1"
                             wire:key="image_{{ $image->id }}"
                             x-on:mouseover="active = '{{ $image->getUrl('large') }}';">
                            <img loading="lazy"
                                 class="object-cover rounded-xl"
                                 src="{{ $image->getUrl('small') }}"
                                 alt="{{ $this->product->translateAttribute('name') }}" />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="ml-2">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl">
                        @if ($brand = $this->product->brand)
                        <a href="{{ route('brand.view', $brand->defaultUrl->slug) }}" class="block" wire:navigate>
                            <span>{{ $brand->name }}</span></a>
                        @endif
                        <span class="font-bold">{{ $this->product->translateAttribute('name') }}</span>
                    </h1>

                    @if ($this->variant->canBeFulfilledAtQuantity(1))
                    <x-product-price class="text-right" :variant="$this->variant" />
                    @endif
                </div>

                <p class="mt-1 text-sm text-gray-500 mb-4">
                    {{ $this->variant->sku }}
                </p>

                <article class="mt-4 text-gray-700 mb-4">
                    {!! $this->product->translateAttribute('description') !!}
                </article>

                <form>
                    <div class="space-y-4">
                        @foreach ($this->productOptions as $option)
                            <fieldset>
                                <legend class="text-xs font-medium text-gray-700">
                                    {{ $option['option']->translate('name') }}
                                </legend>

                                <div class="flex flex-wrap gap-2 mt-2 text-xs tracking-wide uppercase"
                                     x-data="{
                                         selectedOption: @entangle('selectedOptionValues').live,
                                         selectedValues: [],
                                     }"
                                     x-init="selectedValues = Object.values(selectedOption);
                                     $watch('selectedOption', value =>
                                         selectedValues = Object.values(selectedOption)
                                     )">
                                    @foreach ($option['values'] as $value)
                                        <button class="px-6 py-4 font-medium border rounded-lg focus:outline-none focus:ring"
                                                type="button"
                                                wire:click="
                                                $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                            "
                                                :class="{
                                                    'bg-indigo-600 border-indigo-600 text-white hover:bg-indigo-700': selectedValues
                                                        .includes({{ $value->id }}),
                                                    'hover:bg-gray-100': !selectedValues.includes({{ $value->id }})
                                                }">
                                            {{ $value->translate('name') }}
                                        </button>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>

                    <div class="max-w-xs mt-8">
                        <livewire:components.add-to-cart :purchasable="$this->variant"
                                                         :wire:key="$this->variant->id">
                    </div>
                </form>
            </div>
        </div>

        @if (count($this->crossSellProducts))
        <livewire:components.carousel title="You might also like these" collectionUrl="sale" 
            :products="$this->crossSellProducts" />
        @endif

        @if (count($this->upSellProducts))
        <livewire:components.carousel title="Get the complete style" collectionUrl="sale" 
            :products="$this->upSellProducts" />
        @endif

        @if (count($this->alternateProducts))
        <livewire:components.carousel title="How about these?" collectionUrl="sale" 
            :products="$this->alternateProducts" />
        @endif
    </div>
</section>
