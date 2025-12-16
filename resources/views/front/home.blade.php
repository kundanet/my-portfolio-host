<x-layout>

{{-- ================= HERO SECTION ================= --}}
<section
    class="relative min-h-screen flex items-center justify-center text-center
           overflow-hidden text-white
           bg-gradient-to-br from-blue-600 to-indigo-700
           dark:from-gray-900 dark:to-gray-800"
>

    {{-- PARALLAX BACKGROUND GLOW --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="parallax absolute top-1/3 left-1/2 -translate-x-1/2
                   w-[600px] h-[600px] rounded-full
                   bg-indigo-400/30 blur-[160px]">
        </div>
    </div>

    {{-- HERO CONTENT --}}
    <div class="relative z-10 px-6">

        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight"
            data-aos="fade-down">

            Hi, I'm
            <span
                class="bg-clip-text text-transparent
                       bg-gradient-to-r from-yellow-300 via-white to-yellow-300
                       animate-glow">
                Kun Danet
            </span>

        </h1>

        <p class="text-2xl font-semibold mb-10"
           data-aos="fade-up">
            <span id="typed-text"></span>
        </p>

        <a href="/projects"
           class="inline-block px-10 py-4 rounded-full font-semibold text-lg
                  bg-white text-indigo-700 shadow-xl
                  hover:scale-110 hover:shadow-2xl
                  animate-cta transition"
           data-aos="zoom-in">
            Explore My Work →
        </a>

    </div>

</section>


{{-- ================= SKILLS PREVIEW ================= --}}
<section class="py-32 bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto text-center">

        <h2 class="text-4xl font-extrabold mb-16 dark:text-white"
            data-aos="fade-up">
            My Skills
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">

            @foreach ($skills as $index => $skill)
                <div
                    class="p-6 rounded-xl bg-white dark:bg-gray-800 shadow-lg
                           hover:-translate-y-2 hover:shadow-2xl
                           transition-all duration-500"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 120 }}">
                    
                    <h3 class="text-xl font-bold dark:text-white">
                        {{ $skill->name }}
                    </h3>

                    <p class="text-sm mt-2 text-gray-500 dark:text-gray-400">
                        {{ $skill->level }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>
</section>


{{-- ================= PROJECTS PREVIEW ================= --}}
<section class="py-32 bg-white dark:bg-gray-950">
    <div class="container mx-auto text-center">

        <h2 class="text-4xl font-extrabold mb-12 dark:text-white"
            data-aos="fade-up">
            Featured Projects
        </h2>

        <p class="text-gray-600 dark:text-gray-400 max-w-xl mx-auto mb-10"
           data-aos="fade-up" data-aos-delay="100">
            A glimpse of what I’ve built — clean UI, solid logic, and real-world use.
        </p>

        <a href="/projects"
           class="inline-block px-10 py-4 rounded-full
                  bg-indigo-600 text-white font-semibold
                  hover:scale-110 transition shadow-lg"
           data-aos="zoom-in">
            View All Projects →
        </a>

    </div>
</section>


{{-- ================= SCROLL + PARALLAX SCRIPT ================= --}}
<script>
/* PARALLAX EFFECT */
window.addEventListener('scroll', () => {
    document.querySelectorAll('.parallax').forEach(el => {
        el.style.transform =
            `translate(-50%, ${window.scrollY * 0.15}px)`;
    });
});
</script>


{{-- ================= HERO ANIMATIONS ================= --}}
<style>
/* GLOW TEXT */
@keyframes glow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.animate-glow {
    background-size: 200% 200%;
    animation: glow 5s ease infinite;
}

/* CTA PULSE */
@keyframes pulseSoft {
    0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.4); }
    50% { box-shadow: 0 0 0 18px rgba(255,255,255,0); }
}
.animate-cta {
    animation: pulseSoft 3s infinite;
}
</style>

</x-layout>
