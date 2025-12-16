@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Add New Project
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

    <form action="{{ route('admin.projects.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        {{-- Project Title --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Project Title
            </label>
            <input type="text" 
                   name="title"
                   class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="Enter project title"
                   required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Description
            </label>
            <textarea name="description" 
                      rows="5"
                      class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                      placeholder="Write something about the project..."
                      required></textarea>
        </div>

        {{-- Link (Optional) --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Project Link (Optional)
            </label>
            <input type="text" 
                   name="link"
                   class="w-full p-3 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="https://example.com">
        </div>

        {{-- Image Upload --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
                Upload Image
            </label>

            <input type="file" 
                   name="image"
                   accept="image/*"
                   class="p-3 w-full rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required>
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-end gap-4 pt-4">

            <a href="{{ route('admin.projects.index') }}"
               class="px-5 py-3 rounded-lg bg-gray-300 dark:bg-gray-700 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-600">
                Cancel
            </a>

            <button
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Save Project
            </button>

        </div>

    </form>
</div>

@endsection
