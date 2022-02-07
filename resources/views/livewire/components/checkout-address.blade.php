<form wire:submit.prevent="save" class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium border-b">
        <span class="text-xl">{{ ucfirst($type) }} Details</span>
        @if($type == 'shipping' && $editing)
            <label class="text-sm">
                <input type="checkbox" value="1" wire:model.defer="shippingIsBilling" />
                Same as billing
            </label>
        @endif
    </div>
    <div class="p-4 space-y-4">
        @if($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name" :errors="$errors->get('address.first_name')" required>
                    <x-input.text wire:model.defer="address.first_name" required />
                </x-input.group>

                <x-input.group label="Last name" :errors="$errors->get('address.last_name')">
                    <x-input.text wire:model.defer="address.last_name" />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Company name" :errors="$errors->get('address.company_name')" required>
                    <x-input.text wire:model.defer="address.company_name" required />
                </x-input.group>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="Contact phone" :errors="$errors->get('address.contact_phone')">
                    <x-input.text wire:model.defer="address.contact_phone" />
                </x-input.group>

                <x-input.group label="Contact email" :errors="$errors->get('address.contact_email')">
                    <x-input.text wire:model.defer="address.contact_email" type="email" />
                </x-input.group>
            </div>

            <hr />

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="Address line 1" :errors="$errors->get('address.line_one')" required>
                    <x-input.text wire:model.defer="address.line_one" required />
                </x-input.group>

                <x-input.group label="Address line 2" :errors="$errors->get('address.line_two')">
                    <x-input.text wire:model.defer="address.line_two" />
                </x-input.group>

                <x-input.group label="Address line 3" :errors="$errors->get('address.line_three')">
                    <x-input.text wire:model.defer="address.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="City" :errors="$errors->get('address.city')" required>
                    <x-input.text wire:model.defer="address.city" required />
                </x-input.group>

                <x-input.group label="State / Province" :errors="$errors->get('address.state')">
                    <x-input.text wire:model.defer="address.state" />
                </x-input.group>

                <x-input.group label="Postcode" :errors="$errors->get('address.postcode')" required>
                    <x-input.text wire:model.defer="address.postcode" required />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Country" required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg" wire:model.defer="address.country_id">
                        <option value>Select a country</option>
                        @foreach($this->countries as $country)
                            <option value="{{ $country->id }}" wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @else
            <dl class="flex">
                <div class="w-1/2">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium">Name</dt>
                            <dd>{{ $address->first_name }} {{ $address->last_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Company</dt>
                            <dd>{{ $address->company_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Phone Number</dt>
                            <dd>{{ $address->contact_phone }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">Email</dt>
                            <dd>{{ $address->contact_email }}</dd>
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <dt class="text-sm font-medium">Address</dt>
                    <dd>
                        {{ $address->line_one }}<br>
                        @if($address->line_two){{ $address->line_two }}<br>@endif
                        @if($address->line_three){{ $address->line_three }}<br>@endif
                        @if($address->city){{ $address->city }}<br>@endif
                        {{ $address->state }}<br>
                        {{ $address->postcode }}<br>
                        {{ $address->country()->first()->native }}
                    </dd>
                </div>
            </dl>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
        @if($editing)
            <button type="submit" wire:key="submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                Continue
            </button>
        @else
            <button type="button" wire:key="edit_btn" wire:click.prevent="$set('editing', true)" class="px-5 py-3 font-medium bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                Edit Details
            </button>
        @endif
        </div>
    </div>
</form>
