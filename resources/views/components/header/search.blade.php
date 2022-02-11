<form
    {{ $attributes->merge(['class' => 'w-full relative']) }}
    action="{{ route('search.view') }}"
>
    <input
        class="w-full pl-10 text-sm transition-colors border border-gray-100 rounded-lg hover:border-gray-200"
        type="search"
        name="term"
        placeholder="Search for products"
        value="{{ $this->term }}"
    />

    <button
        class="absolute p-2 text-gray-600 transition-colors -translate-y-1/2 rounded-md left-1 top-1/2 hover:bg-gray-100 hover:text-gray-700"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            />
        </svg>
    </button>
</form>
