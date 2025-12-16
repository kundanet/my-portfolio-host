<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Kun Danet</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {{-- Alpine.js (REQUIRED for sidebar toggle) --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-200 transition">

<div class="flex min-h-screen">

    {{-- ⭐ SIDEBAR v4 (Collapsible + Mini + Animated) --}}
    <aside x-data="{ open: true }"
        class="h-screen bg-white dark:bg-gray-800 shadow-2xl transition-all duration-300
               flex flex-col border-r border-gray-200 dark:border-gray-700"
        :class="open ? 'w-64' : 'w-20'">

        {{-- Toggle Button --}}
        <button @click="open = !open"
            class="absolute -right-3 top-6 z-20 bg-blue-600 text-white
                   w-7 h-7 flex items-center justify-center rounded-full shadow
                   hover:bg-blue-700 transition">
            <i data-lucide="chevron-left" class="w-4 h-4"
               :class="open ? '' : 'rotate-180'"></i>
        </button>

        {{-- Logo --}}
        <div class="p-6 pb-10 flex items-center gap-3">
            <i data-lucide="shield" class="w-8 h-8 text-blue-600"></i>
            <span class="text-xl font-bold dark:text-white transition-all duration-300"
                :class="open ? 'opacity-100' : 'opacity-0 -ml-12 absolute'">
                Admin Panel
            </span>
        </div>

        {{-- NAV LINKS --}}
        <nav class="flex flex-col gap-2 px-3">

            {{-- Reusable nav item --}}
            @php
                function navItem($route, $icon, $text) {
                    return "
                    <a href='" . route($route) . "'
                        class=\"group flex items-center gap-4 p-3 rounded-lg transition-all
                               hover:bg-blue-100 dark:hover:bg-blue-900
                               " . (request()->routeIs($route) ? "bg-blue-600 text-white dark:bg-blue-700" : "text-gray-700 dark:text-gray-300") . "\">

                        <i data-lucide='$icon'
                            class=\"w-5 h-5 flex-shrink-0 transition-all duration-300 group-hover:scale-110\"></i>

                        <span class=\"text-lg font-medium whitespace-nowrap transition-all duration-300\"
                            :class=\"open ? 'opacity-100' : 'opacity-0 hidden'\">
                            $text
                        </span>
                    </a>";
                }
            @endphp

            {!! navItem('admin.dashboard', 'layout-dashboard', 'Dashboard') !!}
            {!! navItem('admin.skills.index', 'star', 'Skills') !!}
            {!! navItem('admin.projects.index', 'folder', 'Projects') !!}
            {!! navItem('admin.messages.index', 'mail', 'Messages') !!}

        </nav>

        <div class="mt-auto p-6 flex flex-col gap-4">

            {{-- Dark Mode Toggle --}}
            <button id="dark-toggle"
                class="p-3 bg-gray-200 dark:bg-gray-700 rounded-lg transition hover:scale-105
                       flex items-center justify-center">
                🌙
            </button>

            {{-- Logout --}}
            <form action="/logout" method="POST">
                @csrf
                <button class="p-3 bg-red-600 hover:bg-red-700 text-white rounded-lg w-full
                               flex items-center justify-center gap-3">
                    <i data-lucide="log-out"></i>
                    <span x-show="open" class="transition-all">Logout</span>
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-10">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

</div>

{{-- AOS Init --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 700, once: true });</script>

{{-- Dark Mode Script --}}
<script>
const btn = document.getElementById('dark-toggle');
const html = document.documentElement;

if (localStorage.theme === 'dark') {
    html.classList.add('dark');
    btn.textContent = '☀️';
}

btn.addEventListener('click', () => {
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.theme = 'light';
        btn.textContent = '🌙';
    } else {
        html.classList.add('dark');
        localStorage.theme = 'dark';
        btn.textContent = '☀️';
    }
});
</script>

<script>
    lucide.createIcons();
</script>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal"
    class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center z-50">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl w-full max-w-md
                animate__animated animate__zoomIn">

        <h2 class="text-xl font-bold mb-3 dark:text-white">Confirm Delete</h2>

        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Are you sure you want to delete this item?
            This action cannot be undone.
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white rounded-lg">
                Cancel
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(actionUrl) {
    document.getElementById('deleteForm').action = actionUrl;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
</script>

</body>
</html>
