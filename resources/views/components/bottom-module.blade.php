@php

if(!isset($class)){
$class = '';
}

@endphp
<div class="w-1/3 relative float-left top-full {{$class}}" class="" x-data="{open: false}" :class='open ?  "z-50" : "z-30"'>
  <div class="fixed bg-white md:hidden w-screen h-screen top-0 left-0 duration-200 transition-opacity" :class='open ?  "block opacity-100" : " hidden opacity-0"'></div>
  <div class="fixed md:hidden w-screen  top-4 right-4 text-right duration-200 transition-opacity" :class='open ?  "block opacity-100" : " hidden opacity-0"'> x close</div>

  <div @click.away="open=false">
    <div class=" relative group max-h-[calc(100vh+6px)] bg-white border-x-2 border-t-2 border-black transition transform" :class='open ?  "translate-y-[calc(-100%-6px)]" : " -translate-y-[3.5rem] "'>
      <div data-hover @click='open = !open' class="overflow-hidden py-4  max-w-full relative w-full px-4 md:px-8">
        <h1 class=" inline font-sans uppercase  text-sm sm:text-base  relative whitespace-nowrap pointer-events-none">
          <span class="italic  hidden" :class="open ? '' : 'animate-text-loop group-hover:md:inline-block hidden'">{{str_repeat($title . ' ', 10) }}</span>
          <span class="" :class="open ? '' :'group-hover:md:hidden inline'">{{ $title }}</span>
          <span class="italic   hidden" :class="open ? '' : 'animate-text-loop group-hover:md:inline-block hidden'">{{str_repeat($title . ' ', 10) }}</span>
        </h1>

      </div>


      <div class="border-t-2 w-screen md:w-auto bg-white shadow-2xl text-left border-black  relative {{$slotClass}}  md:left-0  max-h-[calc(100vh-3.75rem)] overflow-y-scroll" :class='open ?  "z-40" : "z-30"'>
 
        {{
          $slot
        }}

      </div>
    </div>

  </div>

</div>