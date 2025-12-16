@extends('admin.layout')

@section('content')

<h1 class="text-4xl font-bold mb-10" data-aos="fade-down">
    Messages
</h1>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">

    <table class="w-full text-left">
        <thead>
            <tr class="border-b dark:border-gray-700 text-gray-600 dark:text-gray-300">
                <th class="p-4">From</th>
                <th>Subject</th>
                <th>Status</th>
                <th class="text-right pr-6">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($messages as $message)
            <tr class="border-b dark:border-gray-700
                       hover:bg-gray-100 dark:hover:bg-gray-700 transition">

                <td class="p-4 font-medium dark:text-white">
                    {{ $message->name }}
                </td>

                <td class="text-gray-600 dark:text-gray-300">
                    {{ Str::limit($message->message, 40) }}
                </td>

                <td>
                    @if(!$message->is_read)
                        <span class="px-3 py-1 text-sm bg-red-500 text-white rounded-full">
                            Unread
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm bg-green-500 text-white rounded-full">
                            Read
                        </span>
                    @endif
                </td>

                <td class="pr-6 flex justify-end gap-4 py-4">

                    <a href="{{ route('admin.messages.show', $message->id) }}"
                       class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        <i data-lucide="eye"></i> View
                    </a>

                    <button
                        onclick="openDeleteModal('{{ route('admin.messages.destroy', $message->id) }}')"
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
