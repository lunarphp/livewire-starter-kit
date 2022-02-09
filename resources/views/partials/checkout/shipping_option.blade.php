<form wire:submit.prevent="saveShippingOption" class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium @if($currentStep < $step) text-gray-500 @endif">
        <span class="text-xl">Shipping Option</span>
    </div>
    @if($currentStep >= $step)
        <div class="p-4 border-t">
            @if($currentStep == $step)

                    @foreach($this->shippingOptions as $option)
                        <label class="flex items-center w-full cursor-pointer">
                            <input type="radio" wire:model.defer="chosenShipping" name="shippingOption" value="{{ $option->getIdentifier() }}" />
                            <div class="flex items-center block ml-2">
                                <span class="block mr-2 text-2xl">{{ $option->getPrice()->formatted() }}</span>
                                {{ $option->getDescription() }}
                            </div>
                        </label>
                    @endforeach
                @if($errors->has('chosenShipping'))
                    <p class="p-4 text-sm text-red-500">{{ $errors->first('chosenShipping') }}</p>
                @endif
            @elseif($currentStep > $step && $this->shippingOption)
                <div class="flex justify-between">
                    <span class="text-xl font-medium">{{ $this->shippingOption->getDescription() }}</span>
                    <span>{{ $this->shippingOption->getPrice()->formatted() }}</span>
                </div>
            @endif
        </div>
        <div class="flex justify-end w-full p-4 bg-gray-100">
            <div>
                @if($step == $currentStep)
                    <button type="submit" wire:key="shipping_submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                        <span wire:loading.remove wire:target="saveShippingOption">
                            Choose Shipping
                        </span>
                        <span wire:loading wire:target="saveShippingOption">
                            <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                @else
                    <button type="button" wire:click.prevent="$set('currentStep', {{ $step }})" class="px-5 py-3 font-medium text-gray-600 bg-white rounded-lg hover:bg-gray-200">
                        Edit
                    </button>
                @endif
            </div>
        </div>
    @endif
</form>
