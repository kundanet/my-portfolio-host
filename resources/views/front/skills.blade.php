<x-layout>

<section class="container mx-auto py-28">

    {{-- TITLE --}}
    <h1 class="text-5xl font-extrabold text-center mb-20 tracking-tight"
        data-aos="fade-up">
        <span class="bg-clip-text text-transparent bg-gradient-to-r
                     from-blue-500 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
            My Skills
        </span>
    </h1>

    {{-- SKILLS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

        @foreach ($skills as $index => $skill)

        <div
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg
                   hover:-translate-y-2 hover:shadow-2xl
                   transition-all duration-500"
            data-aos="fade-up"
            data-aos-delay="{{ $index * 120 }}"
        >

            {{-- NAME --}}
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xl font-bold dark:text-white">
                    {{ $skill->name }}
                </h3>

                <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">
                    {{ $skill->level }}
                </span>
            </div>

            {{-- PROGRESS BAR --}}
            <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">

                @php
                    $percent = match($skill->level) {
                        'Beginner' => 30,
                        'Intermediate' => 55,
                        'Advanced' => 75,
                        'Expert' => 90,
                        default => 50
                    };
                @endphp

                <div
                    class="skill-bar h-full rounded-full
                           bg-gradient-to-r from-blue-500 to-indigo-600
                           dark:from-blue-400 dark:to-indigo-500"
                    data-percent="{{ $percent }}">
                </div>
            </div>

        </div>

        @endforeach

    </div>

</section>

{{-- ================= SKILL ANIMATION SCRIPT ================= --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const bars = document.querySelectorAll(".skill-bar");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const percent = bar.dataset.percent;
                bar.style.width = percent + "%";
            }
        });
    }, { threshold: 0.6 });

    bars.forEach(bar => {
        bar.style.width = "0%"; // start hidden
        bar.style.transition = "width 1.4s cubic-bezier(.4,0,.2,1)";
        observer.observe(bar);
    });

});
</script>

</x-layout>
