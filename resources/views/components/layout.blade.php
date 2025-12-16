<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kun Danet | Portfolio</title>

    {{-- Tailwind / Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Typed.js --}}
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-200 transition">

{{-- ================= NAVBAR ================= --}}
<nav class="bg-white dark:bg-gray-800 shadow p-4">
    <div class="container mx-auto flex justify-between items-center">

        {{-- LEFT --}}
        <div class="flex gap-6 items-center">
            <a href="{{ request()->is('admin*') ? '/admin' : '/' }}"
               class="font-semibold hover:text-blue-600 dark:hover:text-blue-400">
                Home
            </a>

            @if (!request()->is('admin*'))
                <a href="/about" class="hover:text-blue-600 dark:hover:text-blue-400">About</a>
                <a href="/skills" class="hover:text-blue-600 dark:hover:text-blue-400">Skills</a>
                <a href="/projects" class="hover:text-blue-600 dark:hover:text-blue-400">Projects</a>
                <a href="/contact" class="hover:text-blue-600 dark:hover:text-blue-400">Contact</a>
            @endif
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-6">

            {{-- Dark mode --}}
            <button id="dark-toggle" class="text-xl">🌙</button>

            @auth
                @php
                    $unread = \App\Models\Message::where('is_read', false)->count();
                @endphp

                <a href="/admin/messages" class="relative hover:text-blue-600">
                    Messages
                    @if($unread > 0)
                        <span class="bg-red-600 text-white text-xs px-2 rounded-full ml-1">
                            {{ $unread }}
                        </span>
                    @endif
                </a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-red-600 hover:underline">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
            @endauth
        </div>

    </div>
</nav>

{{-- ================= MAIN CONTENT ================= --}}
<div class="container mx-auto py-10">
    {{ $slot }}
</div>

{{-- ================= PROJECT MODAL ================= --}}
<div id="projectModal"
     class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center p-5 z-50">

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl w-full max-w-lg shadow-lg relative">

        {{-- Close button --}}
        <button onclick="closeProjectModal()"
                class="absolute top-3 right-4 text-2xl text-gray-500 hover:text-red-500">
            &times;
        </button>

        {{-- Image --}}
        <img id="modalImage"
             class="rounded-lg mb-4 w-full h-56 object-cover">

        {{-- Title --}}
        <h2 id="modalTitle"
            class="text-2xl font-bold dark:text-white">
        </h2>

        {{-- Description --}}
        <p id="modalDescription"
           class="text-gray-700 dark:text-gray-300 mt-3 leading-relaxed">
        </p>
    </div>
</div>

{{-- ================= SCRIPTS ================= --}}

{{-- AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });
</script>

{{-- Typed --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("typed-text")) {
        new Typed("#typed-text", {
            strings: [
                "Full-Stack Developer",
                "Laravel Developer",
                "Flutter Developer",
                "UI/UX Designer"
            ],
            typeSpeed: 60,
            backSpeed: 40,
            loop: true,
        });
    }
});
</script>

{{-- Dark Mode --}}
<script>
const toggleBtn = document.getElementById('dark-toggle');
const html = document.documentElement;

if (localStorage.theme === 'dark') {
    html.classList.add('dark');
    toggleBtn.textContent = "☀️";
}

toggleBtn.addEventListener('click', () => {
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.theme = 'light';
        toggleBtn.textContent = "🌙";
    } else {
        html.classList.add('dark');
        localStorage.theme = 'dark';
        toggleBtn.textContent = "☀️";
    }
});
</script>

{{-- ================= MODAL LOGIC (E2 + E3 + E4) ================= --}}
<script>
// OPEN
function openProjectModal(title, description, image) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalImage').src = "/storage/" + image;

    const modal = document.getElementById('projectModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// CLOSE
function closeProjectModal() {
    const modal = document.getElementById('projectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// CLICK OUTSIDE (E3)
document.getElementById('projectModal').addEventListener('click', function (e) {
    if (e.target === this) {
        closeProjectModal();
    }
});

// ESC KEY (E4)
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('projectModal');
        if (!modal.classList.contains('hidden')) {
            closeProjectModal();
        }
    }
});
</script>

</body>
</html>
