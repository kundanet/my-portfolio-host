@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Message Details
</h1>

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8"
     data-aos="zoom-in">

    {{-- Name --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold dark:text-white">From</h2>
        <p class="text-gray-600 dark:text-gray-300 text-xl">{{ $message->name }}</p>
    </div>

    {{-- Email --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold dark:text-white">Email</h2>
        <p class="text-blue-600 dark:text-blue-400">{{ $message->email }}</p>
    </div>

    {{-- Message --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold dark:text-white">Message</h2>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ $message->message }}
        </p>
    </div>

    {{-- Status --}}
    <div class="mb-10">
        <h2 class="text-lg font-semibold dark:text-white">Status</h2>

        @if(!$message->is_read)
            <span class="px-3 py-1 text-sm rounded-full bg-red-600 text-white">
                Unread
            </span>
        @else
            <span class="px-3 py-1 text-sm rounded-full bg-green-600 text-white">
                Read
            </span>
        @endif
    </div>

    {{-- BUTTONS --}}
    <div class="flex justify-end gap-4">

        <a href="{{ route('admin.messages.index') }}"
           class="px-5 py-3 rounded-lg bg-gray-300 dark:bg-gray-700 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-600">
            Back
        </a>

        <button
            onclick="openDeleteModal('{{ route('admin.messages.destroy', $message->id) }}')"
            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow flex items-center gap-2">
            <i data-lucide="trash"></i> Delete
        </button>

    </div>

</div>

@endsection
