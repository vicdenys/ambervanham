<div class="fixed z-[45] top-full w-[calc(100vw+6px)] -ml-[2px]  content-end items-end">

  <x-bottom-module :title="'About'" :slotClass="'-left-0'">
    <p class=" p-4 sm:p-8 ">
      <span>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?

      </span>
      <span class="mt-4 inline-block">
        <img src="./img/amber-profile.png" alt="profile picture amber van ham">
      </span>
      <span class="mt-4 inline-block">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?

      </span>
      <span class="mt-4 inline-block">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?

      </span>
      <span class="mt-4 inline-block">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?
      </span>
      <span class="mt-4 inline-block">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?
      </span>
      <span class="mt-4 inline-block">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. A omnis optio amet aliquid vel ad illo distinctio voluptatem itaque dolorem, sed quasi, magni debitis nam repellendus eius excepturi natus! Illum?
      </span>
    </p>
  </x-bottom-module>
  <x-bottom-module :title="'Exhibitions'" :class="'-ml-[2px] -mr-[2px] w-[calc(33.33%+4px)] '" :slotClass="'-left-[calc(100%-2px)]'">
    @if(count($ongoingExhibitions))
    <h1 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Ongoing <span class="italic">Events</span> </h1>
    @foreach($ongoingExhibitions as $exhibition)
    <div class="exhibitionListItem border-b-2 py-8 px-8 border-gray-500 " x-data="{openExhibit : false}">
      <h1 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h1>
      <p class="text-gray-500">{{ $exhibition->address }}</p>
      <p class="mt-4">{{date('d.m.Y', strtotime($exhibition->start_date)) }} - {{ date('d.m.Y', strtotime($exhibition->start_date)) }}</p>
      <p class="mt-4" :class="openExhibit ? 'block' : 'hidden'">
        {{ $exhibition->description }}
      </p>
      <p @click="openExhibit = !openExhibit" class="exhibitLink border-b-2 border-black  mt-4 inline-block" x-text="openExhibit ? 'show less' : 'show more' "></p>

    </div>
    @endforeach
    @endif
    @if(count($futureExhibitions))
    <h1 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Future <span class="italic">Events</span></h1>
    @foreach($futureExhibitions as $exhibition)
    <div class="exhibitionListItem border-b-2 py-8 px-8 border-gray-500 " x-data="{openExhibit : false}">
      <h1 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h1>
      <p class="text-gray-500">{{ $exhibition->address }}</p>
      <p class="mt-4">{{date('d.m.Y', strtotime($exhibition->start_date)) }} - {{ date('d.m.Y', strtotime($exhibition->end_date)) }}</p>
      <p class="mt-4" :class="openExhibit ? 'block' : 'hidden'">
        {{ $exhibition->description }}
      </p>
      <p @click="openExhibit = !openExhibit" class="exhibitLink border-b-2 border-black  mt-4 inline-block" x-text="openExhibit ? 'show less' : 'show more' "></p>

    </div>
    @endforeach
    @endif
    @if(count($pastExhibitions))
    <h1 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Past <span class="italic">Events</span></h1>
    @foreach($pastExhibitions as $exhibition)
    <div class="exhibitionListItem py-8 px-8 border-b-2 border-gray-500 " x-data="{openExhibit : false}">
      <h1 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h1>
      <p class="text-gray-500">{{ $exhibition->address }}</p>
      <p class="mt-4">{{date('d.m.Y', strtotime($exhibition->start_date)) }} - {{ date('d.m.Y', strtotime($exhibition->start_date)) }}</p>
      <p class="mt-4" :class="openExhibit ? 'block' : 'hidden'">
        {{ $exhibition->description }}
      </p>
      <p @click="openExhibit = !openExhibit" class="exhibitLink border-b-2 border-black  mt-4 inline-block" x-text="openExhibit ? 'show less' : 'show more' "></p>

    </div>
    @endforeach
    @endif

  </x-bottom-module>
  <x-bottom-module :title="'Contact'" :class="' -mr-[5px]'" :slotClass="'-left-[calc(200%+6px)]'">
    <div class="  p-4 sm:p-8">
      <a data-hover target="_blank" class="block font-sans uppercase cursor-none  sm:text-base" href="https://www.instagram.com/amber_vanham/">instagram</a>
      <a data-hover target="_blank" class="block font-sans uppercase cursor-none mt-1 sm:text-base" href="mailto:vanhamamber@gmail.com">mail</a>
    </div>
  </x-bottom-module>



</div>