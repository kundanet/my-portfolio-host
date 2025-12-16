<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Kun Danet Portfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-200 transition">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg hidden md:block">

            <div class="p-6 border-b dark:border-gray-700">
                <h1 class="text-2xl font-bold">
                    <span class="text-blue-600">Admin</span> Panel
                </h1>
            </div>

            <nav class="p-4">

                {{-- Dashboard --}}
                <a href="/admin"
                   class="block px-4 py-3 rounded-lg mb-2
                          hover:bg-blue-600 hover:text-white transition
                          {{ request()->is('admin') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300' }}">
                    📊 Dashboard
                </a>

                {{-- Skills --}}
                <a href="/admin/skills"
                   class="block px-4 py-3 rounded-lg mb-2
                          hover:bg-blue-600 hover:text-white transition
                          {{ request()->is('admin/skills*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300' }}">
                    🧠 Skills
                </a>

                {{-- Projects --}}
                <a href="/admin/projects"
                   class="block px-4 py-3 rounded-lg mb-2
                          hover:bg-blue-600 hover:text-white transition
                          {{ request()->is('admin/projects*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300' }}">
                    📦 Projects
                </a>

                {{-- Messages --}}
                @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                <a href="/admin/messages"
                   class="block px-4 py-3 rounded-lg mb-2 relative
                          hover:bg-blue-600 hover:text-white transition
                          {{ request()->is('admin/messages*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300' }}">
                    ✉️ Messages
                    @if($unread > 0)
                        <span class="absolute right-4 top-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                            {{ $unread }}
                        </span>
                    @endif
                </a>

                {{-- Profile --}}
                <a href="/profile"
                   class="block px-4 py-3 rounded-lg mt-4
                          hover:bg-blue-600 hover:text-white transition text-gray-700 dark:text-gray-300">
                    ⚙️ Profile Settings
                </a>

                {{-- Logout --}}
                <form method="POST" action="/logout" class="mt-4 px-4">
                    @csrf
                    <button class="w-full text-left px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>

            </nav>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true })</script>

</body>
</html>
