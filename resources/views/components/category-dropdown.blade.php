<div class="relative inline-block text-left" @click.away="dropdownOpen = false">
  <div>
    <button @click="dropdownOpen = !dropdownOpen" type="button" class="inline-flex w-full justify-center  border px-4 py-3 text-sm font-light border-black text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-100" id="menu-button" aria-expanded="true" aria-haspopup="true">

      @if($selectedCategory)
      {{ $selectedCategory->title }}
      @else
      Category
      @endif
      <!-- Heroicon name: mini/chevron-down -->
      <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>

  <!--
    Dropdown menu, show/hide based on menu state.

    Entering: "transition ease-out duration-100"
      From: "transform opacity-0 scale-95"
      To: "transform opacity-100 scale-100"
    Leaving: "transition ease-in duration-75"
      From: "transform opacity-100 scale-100"
      To: "transform opacity-0 scale-95"
  -->
  <div x-show="dropdownOpen" class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-green  bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    @if($selectedCategory)
    <a href="/dashboard" class="text-white font-light block px-4 py-2 text-sm bg-black" role="menuitem" tabindex="-1" id="menu-item-0">remove filter</a>
    @endif
    @foreach($categories as $category)
    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
    
    <a href="/dashboard?category={{$category->id}}" class="text-black font-light block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $category->title }}</a>

    @endforeach

  </div>
</div>