<form wire:submit.prevent="saveAddress('{{ $type }}')" class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium @if($currentStep < $step) text-gray-500 @else border-b @endif">
        <span class="text-xl ">{{ ucfirst($type) }} Details</span>
        @if($type == 'shipping' && $step == $currentStep)
            <label class="text-sm">
                <input type="checkbox" value="1" wire:model.defer="shippingIsBilling" />
                Same as billing
            </label>
        @endif
    </div>
    @if($currentStep >= $step)
    <div class="p-4 space-y-4">
        @if($step == $currentStep)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name" :errors="$errors->get($type.'.first_name')" required>
                    <x-input.text wire:model.defer="{{ $type }}.first_name" required />
                </x-input.group>

                <x-input.group label="Last name" :errors="$errors->get($type.'.last_name')" required>
                    <x-input.text wire:model.defer="{{ $type }}.last_name" />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Company name" :errors="$errors->get($type.'.company_name')" required>
                    <x-input.text wire:model.defer="{{ $type }}.company_name" required />
                </x-input.group>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="Contact phone" :errors="$errors->get($type.'.contact_phone')">
                    <x-input.text wire:model.defer="{{ $type }}.contact_phone" />
                </x-input.group>

                <x-input.group label="Contact email" :errors="$errors->get($type.'.contact_email')">
                    <x-input.text wire:model.defer="{{ $type }}.contact_email" type="email" />
                </x-input.group>
            </div>

            <hr />

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="Address line 1" :errors="$errors->get($type.'.line_one')" required>
                    <x-input.text wire:model.defer="{{ $type }}.line_one" required />
                </x-input.group>

                <x-input.group label="Address line 2" :errors="$errors->get($type.'.line_two')">
                    <x-input.text wire:model.defer="{{ $type }}.line_two" />
                </x-input.group>

                <x-input.group label="Address line 3" :errors="$errors->get($type.'.line_three')">
                    <x-input.text wire:model.defer="{{ $type }}.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="City" :errors="$errors->get($type.'.city')" required>
                    <x-input.text wire:model.defer="{{ $type }}.city" required />
                </x-input.group>

                <x-input.group label="State / Province" :errors="$errors->get($type.'.state')">
                    <x-input.text wire:model.defer="{{ $type }}.state" />
                </x-input.group>

                <x-input.group label="Postcode" :errors="$errors->get($type.'.postcode')" required>
                    <x-input.text wire:model.defer="{{ $type }}.postcode" required />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Country" required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg" wire:model.defer="{{ $type }}.country_id">
                        <option value>Select a country</option>
                        @foreach($this->countries as $country)
                            <option value="{{ $country->id }}" wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @elseif($currentStep > $step)
            <dl class="flex">
                <div class="w-1/2">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium">Name</dt>
                            <dd>{{ $this->{$type}->first_name }} {{ $this->{$type}->last_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Company</dt>
                            <dd>{{ $this->{$type}->company_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Phone Number</dt>
                            <dd>{{ $this->{$type}->contact_phone }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Email</dt>
                            <dd>{{ $this->{$type}->contact_email }}</dd>
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <dt class="text-sm font-medium">Address</dt>
                    <dd>
                        {{ $this->{$type}->line_one }}<br>
                        @if($this->{$type}->line_two){{ $this->{$type}->line_two }}<br>@endif
                        @if($this->{$type}->line_three){{ $this->{$type}->line_three }}<br>@endif
                        @if($this->{$type}->city){{ $this->{$type}->city }}<br>@endif
                        {{ $this->{$type}->state }}<br>
                        {{ $this->{$type}->postcode }}<br>
                        {{ $this->{$type}->country?->native }}
                    </dd>
                </div>
            </dl>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        @if($step == $currentStep)
            <button
                type="submit"
                wire:key="submit_btn"
                class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                wire:loading.attr="disabled"
                wire:target="saveAddress"
            >
                <span wire:loading.remove wire:target="saveAddress">
                    Save Address
                </span>
                <span wire:loading wire:target="saveAddress">
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
    @endif
</form>
