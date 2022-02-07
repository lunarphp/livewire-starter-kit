<div>
  <header class="border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
      <div class="flex items-center">
        <a href="" class="flex flex-shrink-0">
          <span class="inline-block w-20 h-10 bg-gray-200 rounded-lg"></span>
        </a>

        <nav class="items-center hidden pl-8 ml-8 space-x-8 text-sm font-medium border-l border-gray-100 md:flex">
          @foreach($this->collections as $collection)
            <a
                href="{{ route('collection.view', $collection->defaultUrl->slug) }}"
            >{{ $collection->translateAttribute('name') }}</a>
          @endforeach
        </nav>
      </div>

      <form action="{{ route('search.view') }}" class="relative mx-12 grow">
        <input type="text" class="w-full px-3 py-2 pl-12 border border-black" name="term" placeholder="Search for products" value="{{ $this->term }}" />
        <button class="absolute top-0 left-0 mt-3 ml-4">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 "
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

      <div class="flex items-center">
        <div class="items-center hidden divide-x divide-gray-100 lg:flex">
          <a href="" class="block px-6 text-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-4 h-4 mx-auto"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
              />
            </svg>
            <span class="block mt-1 text-xs font-medium">Account</span>
          </a>
        </div>

        <div>
            @livewire('components.cart')
        </div>

        <button
          type="button"
          class="inline-flex flex-col items-center justify-center w-16 h-16 bg-gray-100 border-l border-white lg:hidden"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </header>
</div>
