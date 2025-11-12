<div class="space-y-2 divide-y">
    @foreach($this->displayFacets as $displayFacet)
        <div class="space-y-2 py-2" wire:key="facet_{{ $displayFacet->field }}">
            <p  class="font-medium text-sm leading-120 text-black">
                {{ $displayFacet->label }}
            </p>
            <div class="space-y-1">
                @foreach($displayFacet->values as $facetValue)
                    <div
                        class="flex gap-2 items-center max-lg:mt-5 cursor-pointer"
                        wire:key="facet_{{ $displayFacet->field }}_value_{{ $facetValue->value }}"
                    >
                        <div>
                            <span
                                @class([
                                   'flex items-center w-4 h-4 rounded-full',
                                   'bg-gray-100 text-white' => !$facetValue->active,
                                   'bg-blue-500 text-white' => $facetValue->active,
                                ])
                            >
                                @if($facetValue->active)
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto lucide lucide-circle-check"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                    @endif
                            </span>
                            <input
                                type="checkbox"
                                name="facets"
                                value="{{ $displayFacet->field }}:{{ $facetValue->value }}"
                                id="{{ $displayFacet->field }}:{{ $facetValue->value }}"
                                wire:model.live="facets"
                                class="hidden"
                            />
                        </div>
                        <label
                            for="{{ $displayFacet->field }}:{{ $facetValue->value }}"
                            @class([
                                'hover:cursor-pointer font-medium grow text-sm leading-120 text-slate-grey grid grid-cols-6  ',
                                'text-gray-500 hover:text-gray-800' => !$facetValue->active,
                                'text-blue-500' => $facetValue->active,
                            ])
                        >
                            <span class="truncate col-span-5" title="{!! $facetValue->label !!}">{!! $facetValue->label !!}</span>
                            <span class="text-right text-xs text-gray-500">({{ $facetValue->count }})</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
