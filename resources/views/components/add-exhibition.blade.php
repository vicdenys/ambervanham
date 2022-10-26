<div class=" sm:w-[30rem] ">
  <form method="POST" id="exhibitionUploadForm" enctype="multipart/form-data" action="{{ route('upload-exhibition') }}">
    @csrf




    <h1 class="font-light font-victorianna-thin text-xl mb-4">New Exhibition</h1>

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
      <input type="hidden" id="exhibitionId" name="exhibitionId" x-model="exhibitionId">

      <div>
        <label for="exhibitionTitle">Title</label>
        <input name="exhibitionTitle" x-model="formData.title" type="text" name="exhibitionTitle" maxlength="254" required class="w-full  bg-white mb-4 border-green border" id="exhibitionTitle">
      </div>

      <div>
        <label for="exhibitionAddress">Address</label>
        <input name="exhibitionAddress" x-model="formData.address" type="text" name="exhibitionAddress" maxlength="254" required class="w-full  bg-white mb-4 border-green border" id="exhibitionAddress">
      </div>
      <div class="mb-4">
        <label for="exhibitionDescription">Description</label>
        <textarea name="exhibitionDescription" x-model="formData.description" name="exhibitionDescription" maxlength="65000" class="w-full bg-white border-green border max-h-24 h-24" id="exhibitionDescription"></textarea>
      </div>

      <div class="flex gap-4">
        <div>
          <label for="exhibitionStartDate">Start Date</label>
          <input name="exhibitionStartDate" x-model="formData.start_date" placeholder="yyyy-mm-dd" type="date" name="exhibitionStartDate" maxlength="254" required class="w-full  bg-white mb-4 border-green border" id="exhibitionStartDate">
        </div>
        <div>
          <label for="exhibitionEndDate">End Date</label>
          <input name="exhibitionEndDate" placeholder="yyyy-mm-dd" x-model="formData.end_date" type="date" name="exhibitionEndDate" maxlength="254" required class="w-full  bg-white mb-4 border-green border" id="exhibitionEndDate">
        </div>
      </div>


    </div>





    <div class="flex items-center justify-end mt-4">



      <button aria-label="close modal" @click=" open = false; document.getElementById('exhibitionUploadForm').reset()" class="inline-flex font-light items-center px-4 py-2 bg-green lowercase  border  text-white bg-black hover:shadow-lg hover:scale-105 focus:bg-white focus:text-green focus:shadow-lg focus:scale-105 shadow-gray-900  hover:bg-white hover:text-black cursor-pointer hover:text-green active:bg-white hover:border-green focus:border-green active:border-green focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
        annuleren
      </button>
      <x-button color='white' negative-color='black' class="ml-3 ">
        {{ __('bevestigen') }}
      </x-button>
    </div>
  </form>

</div>