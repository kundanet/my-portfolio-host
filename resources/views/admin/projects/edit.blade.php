@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Edit Project
</h1>

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8"
     data-aos="zoom-in">

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-600 text-white">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block mb-2 font-medium dark:text-gray-200">
                Project Title
            </label>
            <input type="text" 
                   name="title"
                   value="{{ $project->title }}"
                   class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-2 font-medium dark:text-gray-200">
                Description
            </label>
            <textarea name="description" 
                      rows="5"
                      class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                      required>{{ $project->description }}</textarea>
        </div>

        {{-- Link --}}
        <div>
            <label class="block mb-2 font-medium dark:text-gray-200">
                Project Link (optional)
            </label>
            <input type="text" 
                   name="link"
                   value="{{ $project->link }}"
                   class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="https://example.com">
        </div>

        {{-- Current Image --}}
        <div>
            <label class="block mb-2 font-medium dark:text-gray-200">
                Current Image
            </label>

            <img src="{{ asset('storage/' . $project->image) }}"
                 class="w-40 h-32 object-cover rounded-lg shadow mb-3">

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                Upload a new image (optional)
            </p>

            <input type="file" 
                   name="image"
                   accept="image/*"
                   class="p-3 w-full rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   onchange="previewImage(event)">
        </div>

        {{-- LIVE IMAGE PREVIEW --}}
        <div id="preview-container" class="hidden mt-4">
            <label class="block mb-2 font-medium dark:text-gray-200">New Image Preview:</label>
            <img id="preview-image" class="w-40 h-32 object-cover rounded-lg shadow">
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-end gap-4 pt-4">

            <a href="{{ route('admin.projects.index') }}"
               class="px-5 py-3 rounded-lg bg-gray-300 dark:bg-gray-700 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-600">
                Cancel
            </a>

            <button
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow flex items-center gap-2">
                <i data-lucide="save"></i> Save Changes
            </button>

        </div>

    </form>
</div>

{{-- PREVIEW SCRIPT --}}
<script>
function previewImage(event) {
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('preview-image');
    
    previewContainer.classList.remove('hidden');
    previewImg.src = URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection
