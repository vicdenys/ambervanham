<x-app-layout>

    <div x-init='{{ $errors->any() ? "{open: true }" : "{open: false}" }}' x-data="ExhibitionForm()">
        <x-slot name="header">
            <h2 class="font-semibold  text-black leading-tight">
                {{ __('exhibition') }}
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

                <x-button color='black' negative-color='black' @click="newExhibition()" class="my-6 mb-12">
                    {{ __('new exhibition') }}
                </x-button>
                <div class=" ">

                    <div class="">

                        <x-exhibition-table  :exhibitions="$exhibitions"></x-exhibition-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="pdfUpload">
            <x-add-exhibition :exhibitions="$exhibitions"></x-add-exhibition>
        </x-modal>
    </div>

    <script>
        function ExhibitionForm() {
            return {
                formData: {
                    title: '',
                    description: '',
                    address: '',
                    start_date: '',
                    end_date: '',
                },
                files: null,
                exhibitionId: 0,
                imageUrl: '',
                isEditing: false,
                open: false,
                newExhibition() {
                    this.isEditing = false;
                    this.open = true;
                    this.formData.title = this.formData.description = this.formData.address = this.formData.start_date = this.formData.end_date = '';
                    document.getElementById('exhibitionUploadForm').setAttribute('method', 'POST');
                    let formURL = document.getElementById('exhibitionUploadForm').setAttribute('action',  document.getElementById('exhibitionUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/upload-exhibition'));
                },
                updateArtwork(title, description, address, startDate, endDate, exhibitionId) {
                    this.exhibitionId = exhibitionId;
                    this.open = true;
                    this.isEditing = true;
                    this.formData.title = title;
                    this.formData.description = description;
                    this.formData.address = address;
                    this.formData.start_date = startDate;
                    this.formData.end_date = endDate;


                    document.getElementById('exhibitionUploadForm').setAttribute('method', 'post');
                    let formURL = document.getElementById('exhibitionUploadForm').setAttribute('action',  document.getElementById('exhibitionUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/update-exhibition/' + this.exhibitionId));
                },




            };
        }
    </script>

</x-app-layout>