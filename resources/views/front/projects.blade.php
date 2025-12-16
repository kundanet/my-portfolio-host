<x-layout>

{{-- ================= PROJECTS SECTION ================= --}}
<section class="container mx-auto py-24">

    {{-- PAGE TITLE --}}
    <h1 class="text-5xl font-extrabold text-center mb-16"
        data-aos="fade-up">
        <span class="bg-clip-text text-transparent
                     bg-gradient-to-r from-blue-500 to-indigo-600">
            My Projects
        </span>
    </h1>

    {{-- PROJECT GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        @foreach ($projects as $project)
        <div
            class="bg-white/70 dark:bg-gray-800/60 backdrop-blur-lg
                   rounded-2xl shadow-lg p-5 cursor-pointer
                   hover:-translate-y-2 hover:shadow-2xl
                   transition-all duration-500"

            {{-- OPEN MODAL --}}
            onclick="openProjectModal(
                '{{ addslashes($project->title) }}',
                '{{ addslashes($project->description) }}',
                '{{ asset('storage/'.$project->image) }}'
            )"

            data-aos="zoom-in"
        >

            {{-- IMAGE --}}
            <div class="overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('storage/'.$project->image) }}"
                     class="w-full h-48 object-cover rounded-xl
                            hover:scale-110 transition duration-500"
                     loading="lazy">
            </div>

            {{-- TITLE --}}
            <h3 class="text-2xl font-bold dark:text-white mb-2">
                {{ $project->title }}
            </h3>

            {{-- SHORT DESCRIPTION --}}
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                {{ Str::limit($project->description, 90) }}
            </p>

        </div>
        @endforeach

    </div>

</section>

{{-- ================= PROJECT MODAL ================= --}}
<div id="projectModal"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden
            items-center justify-center z-50">

    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl
                max-w-3xl w-full p-6 relative
                animate-scaleIn">

        {{-- CLOSE BUTTON --}}
        <button onclick="closeProjectModal()"
                class="absolute top-4 right-4 text-gray-500
                       hover:text-red-500 text-2xl">
            ✕
        </button>

        {{-- MODAL IMAGE --}}
        <img id="modalImage"
             class="w-full h-72 object-cover rounded-xl mb-6">

        {{-- MODAL TITLE --}}
        <h2 id="modalTitle"
            class="text-3xl font-bold mb-4 dark:text-white"></h2>

        {{-- MODAL DESCRIPTION --}}
        <p id="modalDescription"
           class="text-gray-700 dark:text-gray-300 leading-relaxed"></p>

    </div>
</div>

{{-- ================= MODAL SCRIPT ================= --}}
<script>
const modal = document.getElementById('projectModal');

function openProjectModal(title, description, image) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalImage').src = image;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden'; // lock scroll
}

function closeProjectModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// CLICK OUTSIDE TO CLOSE
modal.addEventListener('click', (e) => {
    if (e.target === modal) closeProjectModal();
});

// ESC KEY TO CLOSE
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeProjectModal();
});
</script>

{{-- ================= MODAL ANIMATION ================= --}}
<style>
@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.92);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
.animate-scaleIn {
    animation: scaleIn 0.25s ease-out;
}
</style>

</x-layout>
