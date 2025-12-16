@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Add New Skill
</h1>

<div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8"
     data-aos="zoom-in">

    {{-- FORM --}}
    <form action="{{ route('admin.skills.store') }}" method="POST">
        @csrf

        {{-- Skill Name --}}
        <label class="block mb-2 font-semibold dark:text-gray-200">
            Skill Name
        </label>

        <div class="flex items-center gap-3 mb-6 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg 
                    border dark:border-gray-600">
            <i data-lucide="type" class="text-gray-600 dark:text-gray-300"></i>
            <input type="text" name="name"
                   class="w-full bg-transparent outline-none dark:text-white"
                   placeholder="Enter skill name..."
                   required>
        </div>

        {{-- Skill Level --}}
        <label class="block mb-2 font-semibold dark:text-gray-200">
            Skill Level
        </label>

        <div class="flex items-center gap-3 mb-8 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg 
                    border dark:border-gray-600">
            <i data-lucide="bar-chart-3" class="text-gray-600 dark:text-gray-300"></i>

            <select name="level" required
                    class="w-full bg-transparent outline-none dark:bg-gray-700 
                           dark:text-white">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                <option value="Expert">Expert</option>
            </select>
        </div>

        {{-- SUBMIT BUTTON --}}
        <button
            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg 
                   hover:bg-blue-700 hover:scale-[1.02] transition-all shadow-lg flex 
                   items-center justify-center gap-2">
            <i data-lucide="plus-circle"></i>
            Add Skill
        </button>

        {{-- BACK LINK --}}
        <div class="text-center mt-5">
            <a href="{{ route('admin.skills.index') }}"
               class="text-gray-600 dark:text-gray-300 hover:underline flex 
                      justify-center items-center gap-1">
                <i data-lucide="arrow-left"></i> Back to Skills
            </a>
        </div>

    </form>

</div>

@endsection
