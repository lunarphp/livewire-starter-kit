<div class="space-y-2 divide-y">
    @foreach($this->displayFacets as $displayFacet)
        <div class="space-y-2 py-2" wire:key="facet_{{ $displayFacet->field }}">
            <p  class="font-medium text-sm leading-120 text-black">
                {{ $displayFacet->label }}
            </p>
            <div>
                @foreach($displayFacet->values as $facetValue)
                    <label
                        class="flex gap-2 items-center max-lg:mt-5 cursor-pointer"
                        wire:key="facet_{{ $displayFacet->field }}_value_{{ $facetValue->value }}"
                    >
                        <input
                            type="checkbox"
                            name="facets"
                            value="{{ $displayFacet->field }}:{{ $facetValue->value }}"
                            wire:model.live="facets"
                        />
                        <span class="font-medium grow text-sm leading-120 text-slate-grey grid grid-cols-6">
                                        <span class="truncate col-span-5" title="{!! $facetValue->label !!}">{!! $facetValue->label !!}</span>
                                        <span class="text-right text-xs text-gray-500">({{ $facetValue->count }})</span>
                                    </span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
