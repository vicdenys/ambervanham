@extends('layouts.master' , ['isDarkTheme' => 'true', 'title' => 'Home'])

@section('content')
<div x-data="artwork" class="h-full w-full absolute top-0 left-0">
    <div id="progressbard" class=" fixed bottom-24  md:top-6 h-px w-56 md:w-96 left-1/2 -translate-x-1/2  py-2 ">
        <div id="progressbarLine" class="absolute bg-black w-full scale-x-0 h-[2px] top-1/2 left-0 -translate-y-1/2 transfrom"></div>
        <div id="progressbarBorder" class="absolute w-[calc(100%+0.5rem)] top-0 left-1/2 -translate-x-1/2 scale-y-0 transform h-full border-x-2 border-black"></div>
        <div id="progressbarTip" class="absolute rounded-full w-2 scale-0 h-2 bg-black left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="fixed z-40 right-4 md:right-8 top-[1.4rem]  " :class='categoriesOpen ?  "" : "group"'>
        <p @click='categoriesOpen = !categoriesOpen' class="text-right block mb-4 uppercase text-sm right-0">Categories</p>
        <div class="flex gap-2 max-w-[25rem] justify-end text-lg items-center flex-wrap">

            @foreach($categories as $category)
            <div>
                <p data-hover @click="toggleCategory('{{$category->title}}')" class=" px-2 py-1 text-sm transition-transform delay-{{$loop->index * 50}} text-sans border-black border-2 uppercase " :class="[selectedCategory.includes('{{$category->title}}') ? 'bg-black text-white' : 'bg-white text-black ', categoriesOpen ?  'scale-100' : 'group-hover:md:scale-100  scale-0 ']">{{ $category->title}}</p>

            </div>

            @endforeach
        </div>



    </div>

    <div id="artworkDetail" class="fixed z-50 gap-12   w-screen h-screen overflow-y-scroll top-0 left-0" :class="openDetail ? 'block' : 'hidden'">
        <p class="text-center relative z-50 mt-12" @click="imageClicked()">
            x close
        </p>
        <div class="flex flex-wrap z-50 max-w-6xl  absolute w-full relaltive " id="artworkDetailTextWrapper">
            <div class="w-full  px-12 py-8"  >
                <h1 class="slideUp opacity-0 text-3xl" id="artworkDetailtitle" x-text="artworkTitle">
                    Dit is een titel van een artwork
                </h1>
                <div class=" gap-2 mt-4" id="artworkDetailCategories">
                    <template x-for="category in artworkCategories">
                        <p class="bg-black  slideUp opacity-0 mr-2 mb-2 text-white px-2 py-1 inline-block uppercase text-xs" x-text='category'></p>
                    </template>
                </div>
                <div class="mt-4 slideUp opacity-0">
                    <p id="artworkDetailDescription" x-text="artworkDescription" class="whitespace-pre-line">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis, tempora aspernatur. Tempora quo quia laborum officiis.</p>


                </div>
            </div>
            <div class="w-full absolute mb-12 top-0 " id="artworkDetailImageWrapper">

            </div>

        </div>

    </div>


    <div id="slider_wrap" class=" h-2/3  w-screen z-20 fixed top-[calc(50vh-2rem)] left-1/2 transform -translate-x-1/2 -translate-y-1/2 ">
        <div id="slider" @scroll.window="scrollArtworks()" class="noscrollbar   absolute top-[15%] transform  left-0 h-[40vh] sm:h-[45vh] items-start flex ">
            @foreach($artworks as $artwork)
            <div @click="imageClicked({{$artwork->id}})" class="imageCarouselItem {{$artwork->getCategoriesString()}}  self-start  px-8 h-full group  hover:md:scale-110  scale-100 transition-transform duration-500 py-[5vh] transform overflow-hidden origin-center">
                <div id="artworkTitle-{{$artwork->id}}-wrapper" class="absolute  top-20 left-1/2 transform -translate-x-1/2 overflow-hidden">
                    <p id="artworkTitle-{{$artwork->id}}" class=" text-sm block relative font-sans py-1">

                        @foreach(str_split($artwork->title) as $letter)<span class='letter inline-block transform -translate-y-[100px] relative  text-center  uppercase'>{!! $letter == ' ' ? str_replace(' ', '&nbsp;', $letter) : $letter !!}</span>@endforeach

                    </p>
                </div>
                <img id="artworkImage-{{$artwork->id}}" data-artwork-title="{!!$artwork->title!!}" data-artwork-description="{!!$artwork->description!!}" data-artwork-categories="{{ $artwork->getCategoriesString() }}" data-hover @mouseout="removeArtworkTitle('{{$artwork->id}}')" @mousemove="moveArtworkTitle('{{$artwork->id}}')" @mouseenter="changeArtworkTitle('{{$artwork->id}}')" class="imageCarouselImages relative rounded-sm duration-500 transition-all group-hover:shadow-xl shadow-black/20 shadow-md  overflow-hidden left-1/2 transform -translate-x-1/2    origin-center  w-auto max-w-none h-full  bg-white" src="{{ $artwork->image ? '/artwork-files/' . $artwork->image : 'img/default.jpeg' }}" alt="">

            </div>
            @endforeach

        </div>
    </div>


</div>





<x-bottom-nav :futureExhibitions='$futureExhibitions' :pastExhibitions='$pastExhibitions' :ongoingExhibitions='$ongoingExhibitions'></x-bottom-nav>

@stop