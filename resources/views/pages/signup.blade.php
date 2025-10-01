@extends('layouts.app')

@section('title', __('Sign Up'))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<style>
    .cropper-container { max-width: 100%; }
    #imageToCrop { max-width: 100%; }
</style>
@endpush

@section('content')
<div class="form-container" style="max-width: 1000px;">

    <!-- Easy Registration Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{ __('easy_registration') }}</h1>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-md mx-auto">
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-white border border-gray-300 rounded-lg shadow-sm text-gray-700 font-semibold hover:bg-gray-50 transition-all duration-300">
                <svg class="w-5 h-5" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.222,0-9.519-3.487-11.187-8.264l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.574l6.19,5.238C41.38,36.783,44,30.817,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                {{ __('Signup with Google') }}
            </a>
            <button class="w-full flex items-center justify-center gap-3 py-3 px-4 bg-gray-800 border border-transparent rounded-lg shadow-sm text-white font-semibold hover:bg-gray-900 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                {{ __('use_mobile_otp') }}
            </button>
        </div>
        <div class="my-6 text-center text-gray-500">{{ __('OR') }}</div>
    </div>

    <!-- Signup Form -->
    <form action="{{ route('signup.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Profile Image Upload -->
        <h2 class="text-2xl font-bold text-gray-700 pb-2 border-b-2 border-indigo-200 mb-6">{{ __('profile_picture') }}</h2>
        <div class="mb-8 text-center">
             <img id="image-preview" src="https://placehold.co/150x150/e2f0cb/702963?text={{ __('Preview') }}" alt="Image Preview" class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-md mb-4 object-cover">
            <label for="profile_image_input" class="form-label">{{ __('upload_photo_label') }}</label>
            <input type="file" id="profile_image_input" name="profile_image_input" class="form-input" accept="image/*">
            <input type="hidden" name="profile_image" id="profile_image_data">
        </div>

        @include('partials.user-form-fields', ['user' => new \App\Models\User])

        <!-- Final Step -->
        <div class="mt-8 border-t-2 border-white/50 pt-6">
             <div class="flex items-center">
                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" required>
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    {{ __('i_accept_the') }} <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">{{ __('terms_and_conditions') }}</a>
                </label>
            </div>
            <div class="mt-6">
                <button type="submit" class="submit-btn w-full md:w-auto px-10 py-3 text-lg">{{ __('register_now') }}</button>
            </div>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div id="cropModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full relative">
        <button type="button" id="closeCropModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
        <h3 class="text-xl font-bold mb-4">Crop Your Image</h3>
        <div>
            <img id="imageToCrop" src="">
        </div>
        <div class="mt-4 flex justify-end space-x-2">
            <button type="button" id="cancelCrop" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Cancel</button>
            <button type="button" id="cropButton" class="submit-btn px-4 py-2">Crop & Save</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Add Cropper.js and the control script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('profile_image_input');
        const modal = document.getElementById('cropModal');
        const imageToCrop = document.getElementById('imageToCrop');
        const cropButton = document.getElementById('cropButton');
        const cancelCropButton = document.getElementById('cancelCrop');
        const closeCropModalButton = document.getElementById('closeCropModal');
        const hiddenImageDataInput = document.getElementById('profile_image_data');
        const imagePreview = document.getElementById('image-preview');
        let cropper;

        // Open modal when a file is selected
        imageInput.addEventListener('change', function (e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imageToCrop.src = event.target.result;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
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

        // Central function to close and reset the modal
        function closeAndResetModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
            }
            imageInput.value = ''; // Reset the file input
        }

        // Handle the "Crop & Save" button click
        cropButton.addEventListener('click', function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });
                const croppedImageDataURL = canvas.toDataURL('image/jpeg');
                hiddenImageDataInput.value = croppedImageDataURL;
                imagePreview.src = croppedImageDataURL;
                closeAndResetModal();
            }
        });
        
        // Handle the "Cancel" and "X" button clicks
        cancelCropButton.addEventListener('click', closeAndResetModal);
        closeCropModalButton.addEventListener('click', closeAndResetModal);
    });
</script>
@endpush