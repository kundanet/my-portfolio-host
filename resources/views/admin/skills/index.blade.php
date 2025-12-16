@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Manage Skills
</h1>

{{-- Top Bar: Search + Add Button --}}
<div class="flex justify-between items-center mb-6" data-aos="fade-up">

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.skills.index') }}" class="flex gap-3">
        <input type="text" name="search" placeholder="Search skills..."
               value="{{ request('search') }}"
               class="p-3 w-72 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        
        <button class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.skills.index') }}"
               class="px-4 py-3 bg-gray-300 dark:bg-gray-700 rounded-lg text-black dark:text-white">
                Clear
            </a>
        @endif
    </form>

    {{-- Add Button --}}
    <a href="{{ route('admin.skills.create') }}"
       class="px-6 py-3 rounded-lg bg-green-600 shadow hover:bg-green-700 text-white flex items-center gap-2"
       data-aos="zoom-in">
        <i data-lucide="plus-circle"></i> Add Skill
    </a>

</div>

{{-- Skills Table --}}
<div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6" data-aos="fade-up">

    <table class="w-full text-left">
        <thead>
            <tr class="border-b dark:border-gray-700 text-gray-600 dark:text-gray-300">
                <th class="pb-3">Name</th>
                <th>Level</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($skills as $skill)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition">

                {{-- Skill Name --}}
                <td class="py-4 text-lg font-medium dark:text-white">
                    {{ $skill->name }}
                </td>

                {{-- Level Badge --}}
                <td>
                    @php
                        $colors = [
                            'Beginner' => 'bg-gray-400',
                            'Intermediate' => 'bg-blue-500',
                            'Advanced' => 'bg-green-600',
                            'Expert' => 'bg-purple-600',
                        ];
                    @endphp

                    <span class="px-3 py-1 text-sm rounded-full text-white {{ $colors[$skill->level] ?? 'bg-gray-500' }}">
                        {{ $skill->level }}
                    </span>
                </td>

                {{-- ACTIONS --}}
                <td class="py-4 flex justify-end gap-4">

                    {{-- EDIT --}}
                    <a href="{{ route('admin.skills.edit', $skill->id) }}"
                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1">
                        <i data-lucide="pencil"></i> Edit
                    </a>

                    {{-- DELETE (opens modal) --}}
                    <button
                        onclick="openDeleteModal('{{ route('admin.skills.destroy', $skill->id) }}')"
                        class="text-red-600 hover:text-red-700 flex items-center gap-1">
                        <i data-lucide="trash"></i> Delete
                    </button>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
