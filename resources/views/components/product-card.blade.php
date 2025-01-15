@props([
    'name',
    'slug' => null,
    'thumbnail' => null,
    'price'
])

<div class="space-y-2">
    <div class="overflow-hidden rounded-lg">
        @if($slug)<a href="{{ route('product.view', $slug) }}">@endif
            @if ($thumbnail)
                    <img class="object-cover transition-transform duration-300 group-hover:scale-105 w-full"
                         src="{{ $thumbnail }}"
                         alt="{{ $name }}" />

            @else
                <figure class="h-64 w-full bg-gray-100 flex items-center object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="mx-auto text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-images"><path d="M18 22H4a2 2 0 0 1-2-2V6"/><path d="m22 13-1.296-1.296a2.41 2.41 0 0 0-3.408 0L11 18"/><circle cx="12" cy="8" r="2"/><rect width="16" height="16" x="6" y="2" rx="2"/></svg>
                    </div>
                </figure>
            @endif
        @if($slug)</a>@endif
    </div>

    @if($slug)
    <a href="{{ route('product.view', $slug) }}" class="text-sm font-medium hover:underline block">
        {{ $name }}
    </a>
    @else
        {{ $name }}
    @endif

    <p class="mt-1 text-sm text-gray-600">
        <span class="sr-only">
            Price
        </span>
    </p>
    <div>
        {{ $price }}
    </div>
</div>
