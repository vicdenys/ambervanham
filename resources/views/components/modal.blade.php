<div x-show="open" class="fixed  w-screen h-screen top-0 left-0  z-50">

    <div @click="open = false" class=" fixed w-screen h-screen bg-black/70 top-0 left-0 ">

    </div>
    <div class="fixed max-h-screen overflow-y-scroll left-1/2 h-full py-12 -translate-x-1/2">
        <div class=" bg-white  p-6">
            {{ $slot }}
        </div>


    </div>

</div>