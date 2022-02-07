<div>
    <section>

        <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
            <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
                <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                    @if($this->image)
                        <div class="aspect-w-1 aspect-h-1">
                            <img
                                alt="Mobile Phone Stand"
                                class="object-cover rounded-xl"
                                src="{{ $this->image->getUrl('large') }}"
                            />
                        </div>
                    @endif
                    <div class="flex space-x-4">
                    @foreach($this->images as $image)
                        <div class="aspect-w-1 aspect-h-1" wire:key="image_{{ $image->id }}">
                            <img
                                alt="Mobile Phone Stand"
                                class="object-cover rounded-xl"
                                src="{{ $image->getUrl('small') }}"
                            />
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="sticky top-0">
                    <strong class="border border-blue-600 rounded-full tracking-wide px-3 font-medium py-0.5 text-xs bg-gray-100 text-blue-600"> Pre Order </strong>

                    <div class="flex justify-between mt-8">
                        <div class="max-w-[35ch]">
                            <h1 class="text-2xl font-bold">
                                {{ $this->product->translateAttribute('name') }}
                            </h1>
                            {{ $this->variant->sku }}
                        </div>

                        <x-product-price :variant="$this->variant" class="text-lg font-bold" />
                    </div>

                    <article class="relative mt-4">
                        {{ $this->product->translateAttribute('description') }}
                    </article>

                    <form class="mt-8">
                        @foreach($this->productOptions as $option)
                            <fieldset>
                                <legend class="mb-1 text-sm font-medium">{{ $option['option']->translate('name') }}</legend>

                                <div class="flow-root">
                                    <div class="flex flex-wrap -m-0.5">
                                        @foreach($option['values'] as $value)
                                        <button
                                            type="button"
                                            wire:click="$set('selectedOptionValues.{{ $option['option']->id }}', {{ $value->id }})"
                                            class="cursor-pointer p-0.5">
                                            <span
                                                class="
                                                    inline-block px-3 py-1 text-xs font-medium border rounded-full group
                                                    @if($this->selectedOptionValues[$option['option']->id] == $value->id)
                                                        bg-black text-white
                                                    @endif
                                                "
                                            >
                                                {{ $value->translate('name') }}
                                            </span>
                                        </button>
                                        @endforeach
                                    </div>
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
</div>
