<div>
  <div>

    <div class="w-full mx-auto">

      <div class="relative ">
        @if($categories->count())
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          @foreach($categories as $category)

          <div class="w-full border border-black p-4">
            <h1 class="font-bold text-lg ">{{ $category->title }}</h1>
            <p class="mb-8">this category contains {{ $category->files()->count() }} artwork(s)</p>

            <div x-data="{openDeleteModal : false}">
              <x-button @click="updateArtwork('{{$category->title}}', '{{$category->id}}')" color='white' negative-color='black' class=" text-base ">
                {{ __('update') }}
              </x-button>
              <x-button @click="openDeleteModal = true" color='white' negative-color='red-600' class="text-base ">
                {{ __('delete') }}
              </x-button>
              <div x-show="openDeleteModal" class="fixed flex items-center justify-center left-0 top-0 w-screen h-screen ">
                <div @click="openDeleteModal = false" class="w-full h-full absolute left-0 top-0 bg-black/70">

                </div>
                <div class="p-4 sm:w-96 w-[90%] sm:mx-0 bg-white text-black absolute text-left">
                  <h1 class="font-light font-victorianna-thin text-xl mb-4">delete category</h1>
                  <p class="whitespace-normal">
                    are you sure you want to delete <span class="italic text-green/50">'{{$category->title}}'</span>. This can't be undone.

                  </p>

                  <form method="POST" action="delete-category/{{$category->id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group mt-4">

                      <x-button color='white' negative-color='red-600' class="ml-3 float-right text-base ">
                        {{ __('delete') }}
                      </x-button>
                      <button @click=" openDeleteModal = false" class="float-right ml-4  font-light items-center px-4 py-2 border-black bg-black lowercase  border  text-white hover:shadow-lg hover:scale-105 focus:bg-white focus:text-black focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white cursor-pointer hover:text-black active:bg-white hover:border-black focus:border-black active:border-black focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                        cancel
                      </button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
          @endforeach

        </div>

        @else
        <div class="flex w-full py-24 items-center justify-center text-gray-400">
          <p>no categories found</p>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>