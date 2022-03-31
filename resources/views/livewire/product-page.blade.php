<section>
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-12">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-1 md:col-span-7">
                @if ($this->image)
                    <div class="aspect-w-1 aspect-h-1">
                        <img
                            class="object-cover rounded-xl"
                            src="{{ $this->image->getUrl('large') }}"
                            alt="{{ $this->product->translateAttribute('name') }}"
                        />
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    @foreach ($this->images as $image)
                        <div
                            class="aspect-w-1 aspect-h-1"
                            wire:key="image_{{ $image->id }}"
                        >
                            <img
                                class="object-cover rounded-xl"
                                src="{{ $image->getUrl('small') }}"
                                alt="{{ $this->product->translateAttribute('name') }}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:col-span-5 md:py-12 md:sticky md:top-0">
                <div class="flex justify-between">
                    <div class="max-w-xs">
                        <h1 class="text-3xl font-bold">
                            {{ $this->product->translateAttribute('name') }}
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ $this->variant->sku }}
                        </p>
                    </div>

                    <x-product-price
                        class="font-medium"
                        :variant="$this->variant"
                    />
                </div>

                <article class="mt-4">
                    {{ $this->product->translateAttribute('description') }}
                </article>

                <form class="mt-8 space-y-4">
                    @foreach ($this->productOptions as $option)
                        <fieldset>
                            <legend class="text-sm font-medium">
                                {{ $option['option']->translate('name') }}
                            </legend>

                            <div
                                class="flex flex-wrap gap-2 mt-4 text-[10px] uppercase tracking-wide"
                                x-data="{
                                    selectedOption: @entangle('selectedOptionValues'),
                                    selectedValue: '',
                                }"
                                x-init="
                                    selectedValue = selectedOption[{{ $option['option']['id'] }}];
                                    $watch('selectedOption', value => selectedValue = selectedOption[{{ $option['option']['id'] }}])
                                "
                            >
                                @foreach ($option['values'] as $value)
                                    <button
                                        class="px-5 py-3 font-medium border rounded-lg focus:outline-none focus:ring"
                                        type="button"
                                        wire:click="
                                            $set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})
                                        "
                                        :class="{
                                            'bg-blue-600 border-blue-600 text-white hover:bg-blue-700' : selectedValue == {{ $value->id }},
                                            'hover:bg-gray-100': selectedValue != {{ $value->id }}
                                        }"
                                    >
                                        {{ $value->translate('name') }}
                                    </button>
                                @endforeach
                            </div>
                        </fieldset>
                    @endforeach

                    <div class="mt-8">
                        @livewire('components.add-to-cart', [
                        'purchasable' => $this->variant,
                        ], key($this->variant->id))
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
