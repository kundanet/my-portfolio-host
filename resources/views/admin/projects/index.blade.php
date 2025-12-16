@extends('admin.layout')

@section('content')

{{-- PAGE TITLE --}}
<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Manage Projects
</h1>

{{-- TOP BAR --}}
<div class="flex justify-between items-center mb-8" data-aos="fade-up">

    {{-- ADD PROJECT --}}
    <a href="{{ route('admin.projects.create') }}"
       class="px-6 py-3 rounded-lg bg-green-600 shadow hover:bg-green-700 text-white
              flex items-center gap-2">
        <i data-lucide="plus-circle"></i> Add Project
    </a>

</div>

{{-- PROJECTS GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

@foreach($projects as $project)

    <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden
                hover:shadow-2xl transition-all duration-300"
         data-aos="zoom-in">

        {{-- IMAGE --}}
        <div class="relative overflow-hidden">
            <img src="{{ asset('storage/'.$project->image) }}"
                 class="w-full h-48 object-cover
                        group-hover:scale-110 transition-transform duration-500">

            {{-- IMAGE OVERLAY --}}
            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0
                        group-hover:opacity-100 transition flex items-center justify-center">
                <span class="text-white text-lg font-semibold">
                    View Details
                </span>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="p-5">

            <h3 class="text-xl font-bold mb-2 dark:text-white">
                {{ $project->title }}
            </h3>

            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                {{ Str::limit($project->description, 80) }}
            </p>

            {{-- ACTIONS --}}
            <div class="flex justify-between items-center">

                {{-- EDIT --}}
                <a href="{{ route('admin.projects.edit', $project->id) }}"
                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400
                          flex items-center gap-1">
                    <i data-lucide="pencil"></i> Edit
                </a>

                {{-- DELETE --}}
                <button
                    onclick="openDeleteModal('{{ route('admin.projects.destroy', $project->id) }}')"
                    class="text-red-600 hover:text-red-700 flex items-center gap-1">
                    <i data-lucide="trash"></i> Delete
                </button>

            </div>

        </div>

    </div>

@endforeach

</div>

@endsection
