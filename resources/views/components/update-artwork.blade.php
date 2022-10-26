<div class=" sm:w-[30rem] ">
    <form method="PUT" id="artworkUploadForm" enctype="multipart/form-data" action="{{ route('upload-menu') }}" x-data="{ files: null }">
        @csrf




        <h1 class="font-light font-victorianna-thin text-xl mb-4" x-text="files ? 'bestand geselecteerd': 'new artwork'"></h1>

        @if ($errors->any())
        <div class="alert alert-danger" x-show="!files">
            <ul class="text-red-600 mb-4 border border-red-600 p-4 ">
                @foreach ($errors->all() as $error)
                <li class="">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- File -->
        <div class="text-left">

            <div>
                <label for="artworkTitle">Title</label>
                <input name="artworkTitle" type="text" name="menuFile" maxlength="254" required class="w-full  bg-white mb-4 border-green border-2" id="artworkTitle">
            </div>
            <div class="mb-4">
                <label for="artworkDescription">Description</label>
                <textarea name="artworkDescription" name="menuFile" maxlength="254" class="w-full bg-white border-green border-2 max-h-24 h-24" id="artworkDescription"></textarea>
            </div>
            <div class="mb-4">
                <label class="">Category</label>
                <ul class="grid mt-2 gap-x-6 gap-y-2 w-full md:grid-cols-3">
                    @if($categories->count())
                    @foreach($categories as $category)

                    <li>
                        <input name="category-{{ $category->id}}" type="checkbox" id="{{ $category->id }}-option" value="{{ $category->id }}" class="hidden peer" >
                        <label for="{{ $category->id }}-option" class="inline-flex justify-between items-center p-2 w-full text-green bg-white  border-2 border-green cursor-pointer transition-transform  peer-checked:bg-green peer-checked:scale-95 transform peer-checked:text-white hover:bg-green hover:text-white   ">
                            <div class="flex justify-between w-full">
                                <div class="">{{ $category->title }}</div>
                            </div>
                        </label>

                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

            <label for="customFile2">Image</label>
            <label class=" relative bg-white border-green hover:bg-green/10  text-center w-full block   my-2 " :class="{  'h-56 p-3  cursor-pointer border-2': files === null }" for="customFile2">
                <input type="file" name="artworkFile" maxlength="254" accept=".png, .jpg, .jpeg" required class="opacity-0 cursor-pointer w-full h-full z-40 absolute left-0 top-0" id="customFile2" x-on:change="files = Object.values($event.target.files).length > 0 ? Object.values($event.target.files) : null;">
                <div class=" w-full relative  " :class="{  'z-50': files }">
                    <span x-show="!files" x-text="files ? 'bestand geselecteerd' : 'kies bestand of sleep het hier'" :class="{  'text-gray-700': files }"></span>
                    <div x-show="files" class="relative w-full text-left p-2 mt-4 border bg-green border-green text-white">
                        <div class="flex text-left">
                            <span x-text="files ? files.map(file => file.name).join(', '): ''" class="text-left" :class="{  'text-white': files }"></span>
                        </div>
                        <button aria-label="remove file" x-show="files" type="reset" @click="files = null" class="absolute p-1 box-content  right-0 top-0 flex translate-x-1/2 -translate-y-1/2 bg-black  text-white w-3 h-3 items-center justify-center rounded-full">
                            <span class="absolute font-sans text-xs w-2 fill-white ">
                                @svg('cross-icon.svg', '')
                            </span>
                        </button>

                    </div>
                </div>

            </label>

        </div>





        <div class="flex items-center justify-end mt-4">



            <button aria-label="close modal" @click="files = null; open = false; document.getElementById('artworkUploadForm').reset()" class="inline-flex font-light items-center px-4 py-2 bg-green lowercase  border  text-white hover:shadow-lg hover:scale-105 focus:bg-white focus:text-green focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white cursor-pointer hover:text-green active:bg-white hover:border-green focus:border-green active:border-green focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                annuleren
            </button>
            <x-button color='white' negative-color='green' class="ml-3 ">
                {{ __('bevestigen') }}
            </x-button>
        </div>
    </form>
</div>