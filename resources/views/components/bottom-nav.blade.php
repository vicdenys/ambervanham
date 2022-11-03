<div class="fixed z-[45] top-full w-[calc(100vw+6px)] -ml-[2px]  content-end items-end">

  <x-bottom-module :title="'About'" :slotClass="'-left-0'">
    <p class=" p-4 sm:p-8 ">
      <span>
        Amber van Ham (1996) is an Antwerp based artist. Most of her works are about the indistinctive tension field of objective experiences and their subjective values we assign to them. <br>
        <br>
        Everyday life is her favorite theme because there is an enormous stratification in its apparent simplicity. She incorporates these into her black and white drawings.
        <br>
      </span>
    </p>
    <p class=" inline-block px-4 sm:px-8">
      <img src="./img/amber-profile.png" alt="profile picture amber van ham">
    </p>
    <h2 class="mt-8 px-4 sm:px-8 font-serif text-xl">Past residence: </h2>
    <p class="px-4 sm:px-8 ">Gast by Fameus,</p>
    <p class="text-gray-500 px-4 sm:px-8 ">Library Permeke Antwerp, De Coninckplein 36, 2060 Antwerp.</p>
    <p class="px-4 sm:px-8 ">31.03.2022 – 16.05.2022</p>
    <p class="mt-8 px-4 sm:px-8 font-serif text-xl">Collective:</p>
    <p class="px-4 sm:px-8 ">
      Currently active at collective Frappand. With other artists Anke Reilo, Caresse Goossens and Ellen Claes.
    </p>
    <a data-hover target="_blank" class=" px-4 sm:px-8  mb-8 inline-block font-sans uppercase cursor-none  sm:text-base" href="https://www.instagram.com/frap.pand/">instagram frap.pand</a>
  </x-bottom-module>
  <x-bottom-module :title="'Exhibitions'" :class="'-ml-[2px] -mr-[2px] w-[calc(33.33%+4px)] '" :slotClass="'-left-[calc(100%-2px)]'">
    @if(count($ongoingExhibitions))
    <h2 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Ongoing <span class="italic">Events</span> </h2>
    @foreach($ongoingExhibitions as $exhibition)
    <div class="exhibitionListItem border-b-2 py-8 px-8 border-gray-500 " x-data="{openExhibit : false}">
      <h3 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h3>
      <p class="text-gray-500">{{ $exhibition->address }}</p>
      <p class="mt-4">{{date('d.m.Y', strtotime($exhibition->start_date)) }} - {{ date('d.m.Y', strtotime($exhibition->end_date)) }}</p>
      <p class="mt-4" :class="openExhibit ? 'block' : 'hidden'">
        {{ $exhibition->description }}
      </p>
      <p @click="openExhibit = !openExhibit" class="exhibitLink border-b-2 border-black  mt-4 inline-block" x-text="openExhibit ? 'show less' : 'show more' "></p>

    </div>
    @endforeach
    @endif
    @if(count($futureExhibitions))
    <h2 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Future <span class="italic">Events</span></h2>
    @foreach($futureExhibitions as $exhibition)
    <div class="exhibitionListItem border-b-2 py-8 px-8 border-gray-500 " x-data="{openExhibit : false}">
      <h3 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h3>
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
    <h2 class=" px-8 border-b-2 border-black py-4 font-serif text-xl">Past <span class="italic">Events</span></h2>
    @foreach($pastExhibitions as $exhibition)
    <div class="exhibitionListItem py-8 px-8 border-b-2 border-gray-500 " x-data="{openExhibit : false}">
      <h3 class="text-xl capitalize font-serif"> {{ $exhibition->title }}</h3>
      <p class="text-gray-500">{{ $exhibition->address }}</p>
      <p class="mt-4">{{date('d.m.Y', strtotime($exhibition->start_date)) }} - {{ date('d.m.Y', strtotime($exhibition->end_date)) }}</p>
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