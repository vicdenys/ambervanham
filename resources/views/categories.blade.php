<x-app-layout>

    <div x-init='{{ $errors->any() ? "{open: true }" : "{open: false}" }}' x-data="CategoryForm()">
        <x-slot name="header">
            <h2 class="font-semibold  text-black leading-tight">
                {{ __('categories') }}
            </h2>
        </x-slot>

        <x-dashboard-tab>
            
        </x-dashboard-tab>

        <div class="py-6">

            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                @if (Session::has('success'))
                <div class="alert alert-danger mb-4 h-16  overflow-hidden animate-slide-up flex items-center w-full origin-top">
                    <ul class="text-black mb-4  w-full bg-black  px-4 h-full flex items-center ">

                        <li class="text-white">{{ Session::get('success') }}</li>

                    </ul>
                </div>
                @endif

                <x-button color='white' negative-color='black' @click="newCategory()" class="my-6 mb-12">
                    {{ __('new category') }}
                </x-button>
                <div class=" ">

                    <div class="">

                        <x-categories-table  :categories="$categories"></x-categories-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="pdfUpload">
            <x-add-category :categories="$categories"></x-add-category>
        </x-modal>
    </div>

    <script>
        function CategoryForm() {
            return {
                formData: {
                    title: '',
                    description: '',
                },
                files: null,
                categoryId: 0,
                imageUrl: '',
                isEditing: false,
                categories: [],
                open: false,
                newCategory() {
                    this.isEditing = false;
                    this.open = true;
                    this.formData.title = '';
                    document.getElementById('categoryUploadForm').setAttribute('method', 'POST');
                    let formURL = document.getElementById('categoryUploadForm').setAttribute('action',  document.getElementById('categoryUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/upload-category'));
                },
                updateArtwork(title, categoryId) {
                    this.categoryId = categoryId;
                    this.open = true;
                    this.isEditing = true;
                    this.formData.title = title;


                    document.getElementById('categoryUploadForm').setAttribute('method', 'post');
                    let formURL = document.getElementById('categoryUploadForm').setAttribute('action',  document.getElementById('categoryUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/update-category/' + this.artworkId));
                },




            };
        }
    </script>

</x-app-layout>