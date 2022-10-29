<div>

    <div class="w-full mx-auto">

        <div class="relative ">
            @if($files->count())
            <table class="w-full  text-left " x-data="{ dropdownOpen : false}">
                <thead class=" border-y border-black text-black font-light lowercase ">
                    <tr class="font-light font-victorianna-thin">
                        <th scope="col" class=" py-6 font-light gap-4 flex items-center lg:hidden">
                            @sortablelink('title', 'Title')
                            @sortablelink('description', 'Description')
                            @if ( $categories->count())
                            <x-category-dropdown :categories="$categories" :selectedCategory="$selectedCategory"></x-category-dropdown>
                            @else
                            <p>category</p>
                            @endif
                        </th>
                        <th scope="col" class=" py-6 font-light hidden lg:table-cell">
                            
                        </th>

                        <th scope="col" class=" py-6 font-light  hidden lg:table-cell">
                            @sortablelink('title', 'Artwork title')
                        </th>
                        <th scope="col" class=" py-6 font-light hidden lg:table-cell">

                            @sortablelink('description', 'description')
                        </th>
                        <th scope="col" class=" py-6 hidden lg:table-cell " >
                            @if ( $categories->count())
                            <x-category-dropdown :categories="$categories" :selectedCategory="$selectedCategory"></x-category-dropdown>
                            @else
                            <p>category</p>
                            @endif
                        </th>
                        <th scope="col" class=" py-6 hidden lg:table-cell">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class=" py-6 hidden lg:table-cell">
                        </th>
                        <th scope="col" class=" py-6 hidden lg:table-cell">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr class=" border-b  text-black text-base lowercase">
                        <td class="py-6 hidden lg:table-cell">
                            <img id="artwork-image-{{$file->id}}" class=" max-w-[10rem]" src="{{ $file->image ? '/artwork-files/' . $file->image : 'img/default.jpeg' }}" alt="image of {{ $file->title }}">

                        </td>

                        <!-- SHOW  TABLE -->
                        <th scope="row" class="py-6 font-medium">


                            <div class="flex gap-6 max-w-[12rem]">
                                <p class="w-full ">{{$file->title}}</p>
                            </div>

                            <!-- SHOW RESPONSIVE TABLE -->
                            <div class="lg:hidden table-cell max-w-full">
                                <div>
                                    <img id="artwork-image-{{$file->id}}" class=" w-64 my-4" src="{{ $file->image ? '/artwork-files/' . $file->image : 'img/default.jpeg' }}" alt="image of {{ $file->title }}">

                                </div>
                                <p class="font-light whitespace-pre-line" id="artworkDescription-{{$file->id}}">{{ $file->description }}</p>


                                <div class="flex gap-4 mt-4">
                                    <div x-data="{openDeleteModal : false}">
                                        <x-button @click="updateArtwork('{{$file->title}}', {{json_encode($file->categories->all())}}, '{{$file->id}}')" color='white' negative-color='black' class=" text-base ">
                                            {{ __('update') }}
                                        </x-button>
                                        <x-button @click="openDeleteModal = true" color='white' negative-color='red-600' class="text-base ">
                                            {{ __('delete') }}
                                        </x-button>
                                        <div x-show="openDeleteModal" class="fixed flex items-center justify-center left-0 top-0 w-screen h-screen ">
                                            <div @click="openDeleteModal = false" class="w-full h-full absolute left-0 top-0 bg-black/70">

                                            </div>
                                            <div class="p-4 sm:w-96 w-[90%] sm:mx-0 bg-white text-green absolute text-left">
                                                <h1 class="font-light font-victorianna-thin text-xl mb-4">delete file</h1>
                                                <p class="whitespace-normal">
                                                    are you sure you want to delete <span class="italic text-green/50">'{{$file->title}}'</span>. This can't be undone.

                                                </p>

                                                <form method="POST" action="delete-artwork/{{$file->id}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="form-group mt-4">

                                                        <x-button color='white' negative-color='red-600' class="ml-3 float-right text-base ">
                                                            {{ __('delete') }}
                                                        </x-button>
                                                        <button @click=" openDeleteModal = false" class="float-right ml-4  font-light items-center px-4 py-2 border-black bg-black lowercase  border  text-white hover:shadow-lg hover:scale-105 focus:bg-white focus:text-green focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white cursor-pointer hover:text-green active:bg-white hover:border-green focus:border-green active:border-green focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                                                            cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </th>
                        <td class="py-6 hidden lg:table-cell">
                            <div class="flex gap-6 max-w-[12rem]">

                            {{ var_dump(nl2br($file->description)) }}
                                <p class="w-full text-ellipsis max-h-12  font-light overflow-hidden whitespace-pre-line">{{ $file->description }}</p>
                            </div>

                        </td>
                        <td class="py-6 hidden flex lg:table-cell">
                            @forelse ( $file->categories as $category)
                            <p class="inline bg-black font-light text-sm rounded-full py-1 px-2 text-white">{{ $category->title }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td class="py-6 text-right hidden lg:table-cell" x-data="{ openUpdateModal: false}">
                            <x-button @click="updateArtwork('{{$file->title}}', {{json_encode($file->categories->all())}}, '{{$file->id}}')" color='white' negative-color='black' class="ml-3 text-base ">
                                {{ __('update') }}
                            </x-button>

                        </td>
                        <td class="py-6 text-right hidden lg:table-cell" x-data="{ openDeleteModal: false}">
                            <x-button @click="openDeleteModal = true" color='white' negative-color='red-600' class="ml-3 text-base ">
                                {{ __('delete') }}
                            </x-button>
                            <div x-show="openDeleteModal" class="fixed flex items-center justify-center left-0 top-0 w-screen h-screen ">
                                <div @click="openDeleteModal = false" class="w-full h-full absolute left-0 top-0 bg-black/70">

                                </div>
                                <div class="p-4 w-96 bg-white text-green absolute text-left">
                                    <h1 class="font-light font-victorianna-thin text-xl mb-4">delete file</h1>
                                    <p>
                                        are you sure you want to delete <span class="italic text-green/50">'{{$file->title}}'</span>. This can't be undone.

                                    </p>

                                    <form method="POST" action="delete-artwork/{{$file->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group mt-4">

                                            <x-button color='white' negative-color='red-600' class="ml-3 float-right text-base ">
                                                {{ __('delete') }}
                                            </x-button>
                                            <button aria-label="close modal" @click=" openDeleteModal = false" class="float-right ml-4  font-light items-center px-4 py-2 border-green bg-black lowercase  border  text-white hover:shadow-lg hover:scale-105 focus:bg-white focus:text-green focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white cursor-pointer hover:text-black active:bg-white hover:border-black focus:border-black active:border-black focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                                                cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            @else
            <div class="flex w-full py-24 items-center justify-center text-gray-400">
                <p>geen menu gevonden. klik op 'upload pdf' om er een toe te voegen...</p>
            </div>
            @endif

        </div>
    </div>
</div>