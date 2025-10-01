@extends('layouts.app')

@section('title', __('edit_my_profile'))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<style>
    .cropper-container { max-width: 100%; }
    #imageToCrop { max-width: 100%; }
</style>
@endpush

@section('content')
<div class="form-container" style="max-width: 1000px;">

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Profile Image Upload -->
        <h2 class="text-2xl font-bold text-gray-700 pb-2 border-b-2 border-indigo-200 mb-6">{{ __('profile_picture') }}</h2>
        <div class="mb-8 text-center">
             <img id="image-preview" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/e2f0cb/702963?text=' . substr($user->full_name, 0, 1) }}" alt="Image Preview" class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-md mb-4 object-cover">
            <label for="profile_image_input" class="form-label">{{ __('upload_new_photo_label') }}</label>
            <input type="file" id="profile_image_input" class="form-input" accept="image/*">
            <input type="hidden" name="profile_image" id="profile_image_data">
        </div>

        {{-- This partial is now fully translated --}}
        @include('partials.user-form-fields', ['user' => $user])

        <!-- Final Step -->
        <div class="mt-8 border-t-2 border-white/50 pt-6">
            <div class="mt-6">
                <button type="submit" class="submit-btn w-full md:w-auto px-10 py-3 text-lg">{{ __('update_profile') }}</button>
            </div>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div id="cropModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full relative">
        <button type="button" id="closeCropModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
        <h3 class="text-xl font-bold mb-4">{{ __('crop_your_image') }}</h3>
        <div><img id="imageToCrop" src=""></div>
        <div class="mt-4 flex justify-end space-x-2">
            <button type="button" id="cancelCrop" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">{{ __('Cancel') }}</button>
            <button type="button" id="cropButton" class="submit-btn px-4 py-2">{{ __('crop_and_save') }}</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('profile_image_input');
        const modal = document.getElementById('cropModal');
        const imageToCrop = document.getElementById('imageToCrop');
        const cropButton = document.getElementById('cropButton');
        const hiddenImageDataInput = document.getElementById('profile_image_data');
        const imagePreview = document.getElementById('image-preview');
        let cropper;

        function closeModal() {
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
            }
            // Do not reset the file input here, as it might clear the selection
            // before the form is submitted if the user is fast.
        }
        
        document.getElementById('cancelCrop').addEventListener('click', () => {
            closeModal();
            imageInput.value = ''; // Only reset on explicit cancel
        });
        document.getElementById('closeCropModal').addEventListener('click', () => {
            closeModal();
            imageInput.value = ''; // Only reset on explicit cancel
        });
         // Simple script to preview the selected image
    document.getElementById('profile_image').addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });

        imageInput.addEventListener('change', function (e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imageToCrop.src = event.target.result;
                    modal.classList.remove('hidden');
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        background: false,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });

        cropButton.addEventListener('click', function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({ width: 400, height: 400 });
                const croppedImageDataURL = canvas.toDataURL('image/jpeg');
                
                console.log('Cropped data generated. Setting hidden input.');
                hiddenImageDataInput.value = croppedImageDataURL;
                imagePreview.src = croppedImageDataURL;

                // For debugging: check the value right after setting it
                console.log('Hidden input value starts with:', hiddenImageDataInput.value.substring(0, 50) + '...');
                
                closeModal();
            } else {
                console.error('Cropper instance was not found.');
            }
        });
    });

    const tomSelect = new TomSelect('#languages_known',{
        plugins: ['remove_button'],
        create: true,
        createOnBlur: true,
    });

    const selectedContainer = document.getElementById('languages_known_selected');

    const renderBadges = () => {
        console.log('Rendering badges for items:', tomSelect.items);
        selectedContainer.innerHTML = '';
        const selectedItems = tomSelect.items;
        selectedItems.forEach(value => {
            const badge = document.createElement('div');
            badge.className = 'inline-flex items-center px-2.5 py-1.5 mr-2 my-1 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full';
            badge.innerHTML = `
                <span>${value}</span>
                <button type="button" class="inline-flex items-center p-1 ml-2 text-sm text-indigo-400 bg-transparent rounded-sm hover:bg-indigo-200 hover:text-indigo-900" data-value="${value}">
                    <svg class="w-2 h-2" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" /></svg>
                </button>
            `;
            selectedContainer.appendChild(badge);
            badge.querySelector('button').addEventListener('click', () => {
                tomSelect.removeItem(value);
            });
        });
    }

    tomSelect.on('item_add', renderBadges);
    tomSelect.on('item_remove', renderBadges);

    renderBadges();
</script>
@endpush

