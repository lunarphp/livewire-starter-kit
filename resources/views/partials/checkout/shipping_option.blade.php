<form
    wire:submit.prevent="saveShippingOption"
    class="bg-white border border-gray-100 rounded-xl"
>
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <h3 class="font-medium">
            Shipping Options
        </h3>

        @if ($currentStep > $step)
            <button
                class="px-5 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-700"
                type="button"
                wire:click.prevent="$set('currentStep', {{ $step }})"
            >
                Edit
            </button>
        @endif
    </div>

    @if ($currentStep >= $step)
        <div class="p-6">
            @if ($currentStep == $step)
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ($this->shippingOptions as $option)
                        <div>
                            <input
                                class="hidden peer"
                                type="radio"
                                wire:model.defer="chosenShipping"
                                name="shippingOption"
                                value="{{ $option->getIdentifier() }}"
                                id="{{ $option->getIdentifier() }}"
                            />

                            <label
                                class="flex items-center justify-between p-4 text-sm font-medium border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500"
                                for="{{ $option->getIdentifier() }}"
                            >
                                <p>
                                    {{ $option->getDescription() }}
                                </p>

                                <p>
                                    {{ $option->getPrice()->formatted() }}
                                </p>
                            </label>
                        </div>
                    @endforeach
                </div>

                @if ($errors->has('chosenShipping'))
                    <p class="p-4 text-sm text-red-500">
                        {{ $errors->first('chosenShipping') }}
                    </p>
                @endif

            @elseif($currentStep > $step && $this->shippingOption)
                <dl class="flex flex-wrap max-w-xs text-sm">
                    <dt class="w-1/2 font-medium">
                        {{ $this->shippingOption->getDescription() }}
                    </dt>

                    <dd class="w-1/2 text-right">
                        {{ $this->shippingOption->getPrice()->formatted() }}
                    </dd>
                </dl>
            @endif

            @if ($step == $currentStep)
                <div class="mt-6 text-right">
                    <button
                        class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                        type="submit"
                        wire:key="shipping_submit_btn"
                    >
                        <span
                            wire:loading.remove.delay
                            wire:target="saveShippingOption"
                        >
                            Choose Shipping
                        </span>
                        <span
                            wire:loading.delay
                            wire:target="saveShippingOption"
                        >
                            <svg
                                class="w-5 h-5 text-white animate-spin"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    @endif
</form>
