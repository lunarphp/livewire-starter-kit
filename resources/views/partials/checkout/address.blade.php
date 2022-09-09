<form wire:submit.prevent="saveAddress('{{ $type }}')"
      class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            {{ ucfirst($type) }} Details
        </h3>

        @if ($type == 'shipping' && $step == $currentStep)
            <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-50">
                <input class="w-5 h-5 text-green-600 border-gray-100 rounded"
                       type="checkbox"
                       value="1"
                       wire:model.defer="shippingIsBilling" />

                <span class="ml-2 text-xs font-medium">
                    Same as billing
                </span>
            </label>
        @endif

        @if ($currentStep > $step)
            <button class="px-5 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-700"
                    type="button"
                    wire:click.prevent="$set('currentStep', {{ $step }})">
                Edit
            </button>
        @endif
    </div>

    @if ($currentStep >= $step)
        <div class="p-6">
            @if ($step == $currentStep)
                <div class="grid grid-cols-6 gap-4">
                    <x-input.group class="col-span-3"
                                   label="First name"
                                   :errors="$errors->get($type . '.first_name')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.first_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3"
                                   label="Last name"
                                   :errors="$errors->get($type . '.last_name')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.last_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-6"
                                   label="Company name"
                                   :errors="$errors->get($type . '.company_name')">
                        <x-input.text wire:model.defer="{{ $type }}.company_name" />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="Contact phone"
                                   :errors="$errors->get($type . '.contact_phone')">
                        <x-input.text wire:model.defer="{{ $type }}.contact_phone" />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="Contact email"
                                   :errors="$errors->get($type . '.contact_email')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.contact_email"
                                      type="email"
                                      required />
                    </x-input.group>

                    <div class="col-span-6">
                        <hr class="h-px my-4 bg-gray-100 border-none">
                    </div>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 1"
                                   :errors="$errors->get($type . '.line_one')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.line_one"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 2"
                                   :errors="$errors->get($type . '.line_two')">
                        <x-input.text wire:model.defer="{{ $type }}.line_two" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Address line 3"
                                   :errors="$errors->get($type . '.line_three')">
                        <x-input.text wire:model.defer="{{ $type }}.line_three" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="City"
                                   :errors="$errors->get($type . '.city')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.city"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="State / Province"
                                   :errors="$errors->get($type . '.state')">
                        <x-input.text wire:model.defer="{{ $type }}.state" />
                    </x-input.group>

                    <x-input.group class="col-span-3 sm:col-span-2"
                                   label="Postcode"
                                   :errors="$errors->get($type . '.postcode')"
                                   required>
                        <x-input.text wire:model.defer="{{ $type }}.postcode"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-6"
                                   label="Country"
                                   required>
                        <select class="w-full p-3 border border-gray-200 rounded-lg sm:text-sm"
                                wire:model.defer="{{ $type }}.country_id">
                            <option value>Select a country</option>
                            @foreach ($this->countries as $country)
                                <option value="{{ $country->id }}"
                                        wire:key="country_{{ $country->id }}">
                                    {{ $country->native }}
                                </option>
                            @endforeach
                        </select>
                    </x-input.group>
                </div>
            @elseif($currentStep > $step)
                <dl class="grid grid-cols-1 gap-8 text-sm sm:grid-cols-2">
                    <div>
                        <div class="space-y-4">
                            <div>
                                <dt class="font-medium">
                                    Name
                                </dt>

                                <dd class="mt-0.5">
                                    {{ $this->{$type}->first_name }} {{ $this->{$type}->last_name }}
                                </dd>
                            </div>

                            @if ($this->{$type}->company_name)
                                <div>
                                    <dt class="font-medium">
                                        Company
                                    </dt>

                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->company_name }}
                                    </dd>
                                </div>
                            @endif

                            @if ($this->{$type}->contact_phone)
                                <div>
                                    <dt class="font-medium">
                                        Phone Number
                                    </dt>

                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->contact_phone }}
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="font-medium">
                                    Email
                                </dt>

                                <dd class="mt-0.5">
                                    {{ $this->{$type}->contact_email }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <div>
                        <dt class="font-medium">
                            Address
                        </dt>

                        <dd class="mt-0.5">
                            {{ $this->{$type}->line_one }}<br>
                            @if ($this->{$type}->line_two)
                                {{ $this->{$type}->line_two }}<br>
                            @endif
                            @if ($this->{$type}->line_three)
                                {{ $this->{$type}->line_three }}<br>
                            @endif
                            @if ($this->{$type}->city)
                                {{ $this->{$type}->city }}<br>
                            @endif
                            @if ($this->{$type}->state)
                                {{ $this->{$type}->state }}<br>
                            @endif
                            {{ $this->{$type}->postcode }}<br>
                            {{ $this->{$type}->country?->native }}
                        </dd>
                    </div>
                </dl>
            @endif

            @if ($step == $currentStep)
                <div class="mt-6 text-right">
                    <button class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                            type="submit"
                            wire:key="submit_btn"
                            wire:loading.attr="disabled"
                            wire:target="saveAddress">
                        <span wire:loading.remove
                              wire:target="saveAddress">
                            Save Address
                        </span>

                        <span wire:loading
                              wire:target="saveAddress">
                            <span class="inline-flex items-center">
                                Saving

                                <x-icon.loading />
                            </span>
                        </span>
                    </button>
                </div>
            @endif
        </div>

    @endif
</form>
