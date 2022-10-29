<x-app-layout>

    <div x-init='{{ $errors->any() ? "{open: true }" : "{open: false}" }}' x-data="ContactForm()">
        <x-slot name="header">
            <h2 class="font-semibold  text-black leading-tight">
                {{ __('dashboard') }}
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

                <x-button color='white' negative-color='black' @click="newArtwork()" class="my-6 mb-12">
                    {{ __('new artwork') }}
                </x-button>
                <div class=" ">

                    <div class="">

                        <x-files-table :files="$files" :categories="$categories" :selectedCategory="$selectedCategory"></x-files-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="pdfUpload">
            <x-add-artwork :categories="$categories"></x-add-artwork>
        </x-modal>
    </div>

    <script>
        function ContactForm() {
            return {
                formData: {
                    title: '',
                    description: '',
                },
                files: null,
                artworkId: 0,
                imageUrl: '',
                isEditing: false,
                categories: [],
                open: false,
                newArtwork() {
                    console.log('test');
                    this.isEditing = false;
                    this.open = true;
                    document.getElementById('FileUploadInput').required = true;
                    this.formData.title = '';
                    this.formData.description = '';
                    this.files = null;
                    let categoriesArray = Array.from(document.querySelectorAll('[id$="-option"]'));

                    [].forEach.call(categoriesArray, function(ele) {
                        ele.checked = false;
                    });
                    document.getElementById('artworkUploadForm').setAttribute('method', 'POST');
                    let formURL = document.getElementById('artworkUploadForm').setAttribute('action',  document.getElementById('artworkUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/upload-artwork'));
                    console.log(formURL)
                },
                updateArtwork(title, categories, artworkId) {
                    this.artworkId = artworkId;
                    this.open = true;
                    this.isEditing = true;
                    document.getElementById('FileUploadInput').required = false;
                    this.formData.title = title;
                    this.formData.description = document.getElementById(`artworkDescription-${artworkId}`).innerHTML;
                    this.imageUrl = document.getElementById('artwork-image-' + this.artworkId).src;
                    this.getImageFile(this.artworkId);

                    let categoriesArray = Array.from(document.querySelectorAll('[id$="-option"]'));

                    [].forEach.call(categoriesArray, function(ele) {
                        ele.checked = false;
                    });


                    categories.forEach((data) => {
                        if (document.getElementById(data.id + '-option')) {
                            document.getElementById(data.id + '-option').checked = false;
                        }

                        if (document.getElementById(data.id + '-option')) {
                            document.getElementById(data.id + '-option').checked = true;
                        }
                    });

                    document.getElementById('artworkUploadForm').setAttribute('method', 'post');
                    let formURL = document.getElementById('artworkUploadForm').setAttribute('action',  document.getElementById('artworkUploadForm').getAttribute('action').replace(/\/[^\/]*$/, '/update-artwork/' + this.artworkId));
                    console.log(formURL)
                },

                getImageFile: function() {
                    this.toDataURL(this.imageUrl)
                        .then(dataUrl => {
                            var fileData = this.dataURLtoFile(dataUrl, this.artworkId + '.' + this.imageUrl.split('.').pop());
                            this.files = [fileData];
                        })
                },

                toDataURL: url => fetch(url)
                    .then(response => response.blob())
                    .then(blob => new Promise((resolve, reject) => {
                        const reader = new FileReader()
                        reader.onloadend = () => resolve(reader.result)
                        reader.onerror = reject
                        reader.readAsDataURL(blob)
                    })),


                dataURLtoFile: (dataurl, filename) => {
                    var arr = dataurl.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);
                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }
                    return new File([u8arr], filename, {
                        type: mime
                    });
                },



            };
        }
    </script>

</x-app-layout>