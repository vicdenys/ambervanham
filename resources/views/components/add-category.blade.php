<div class=" sm:w-[30rem] ">
    <form method="POST" id="categoryUploadForm" enctype="multipart/form-data" action="{{ route('upload-category') }}">
        @csrf




        <h1 class="font-light font-victorianna-thin text-xl mb-4">New Category</h1>

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
            <input type="hidden" id="categoryId" name="categoryId" x-model="categoryId">

            <div>
                <label for="categoryTitle">Title</label>
                <input name="categoryTitle" x-model="formData.title" type="text" name="menuFile" maxlength="254" required class="w-full  bg-white mb-4 border-green border" id="categoryTitle">
            </div>

        </div>





        <div class="flex items-center justify-end mt-4">



            <button aria-label="close modal" @click="files = null; open = false; document.getElementById('categoryUploadForm').reset()" class="inline-flex font-light items-center px-4 py-2 bg-green lowercase  border  text-white bg-black hover:shadow-lg hover:scale-105 focus:bg-white focus:text-green focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white hover:text-black cursor-pointer hover:text-green active:bg-white hover:border-green focus:border-green active:border-green focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                annuleren
            </button>
            <x-button color='white' negative-color='black' class="ml-3 ">
                {{ __('bevestigen') }}
            </x-button>
        </div>
    </form>

</div>