<div class=" bg-black">
  <div class="max-w-7xl mx-auto px-4 pt-6 lg:px-8 flex gap-2">
    <a class="py-4 px-4   {{  request()->is('dashboard') ? 'border-white bg-white text-black ' : 'text-white' }}"  href="/dashboard">Artworks</a>
    <a class="py-4 px-4  {{  request()->is('categories') ? 'border-white bg-white text-black ' : 'text-white' }}"  href="/categories" >Categories</a>
    <a class="py-4 px-4  {{  request()->is('exhibitions') ? 'border-white bg-white text-black ' : 'text-white' }}"  href="/exhibitions" >Exhibitions</a>
  </div>
</div>