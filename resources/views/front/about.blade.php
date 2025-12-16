<x-layout>

<section class="container mx-auto py-24">

    {{-- Section Title --}}
    <h1 class="text-5xl font-extrabold text-center mb-16 tracking-tight"
        data-aos="fade-up">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
            About Me
        </span>
    </h1>

    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

        {{-- Floating glow circles --}}
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-0 -right-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-2xl animate-ping"></div>

        {{-- Image Block --}}
        <div class="relative" data-aos="zoom-in">
            <img src="{{ asset('images/cat.jpg') }}"
                 class="rounded-2xl shadow-2xl w-full object-cover max-h-[420px]">
        </div>

        {{-- Text Section --}}
        <div class="backdrop-blur-lg bg-white/60 dark:bg-gray-800/50 p-10 rounded-2xl shadow-xl"
             data-aos="fade-left">

            <h2 class="text-3xl font-bold mb-5">
                Hello! I'm 
                <span class="text-blue-600 dark:text-blue-400">Kun Danet</span>
            </h2>

            <p class="text-gray-700 dark:text-gray-300 mb-5 leading-relaxed text-lg">
                I am a passionate developer who loves building modern, clean, and 
                user-friendly applications. My focus is on writing elegant code and 
                crafting smooth user experiences.
            </p>

            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                I enjoy learning new technologies, improving my skills, and solving 
                real-world problems through creative solutions. Every project is an 
                opportunity to grow and innovate.
            </p>

            {{-- Skill Tags --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <span class="px-4 py-2 bg-blue-600/10 text-blue-700 dark:text-blue-300 dark:bg-blue-500/20 rounded-full text-sm">
                    Laravel
                </span>
                <span class="px-4 py-2 bg-indigo-600/10 text-indigo-700 dark:text-indigo-300 dark:bg-indigo-500/20 rounded-full text-sm">
                    TailwindCSS
                </span>
                <span class="px-4 py-2 bg-yellow-500/10 text-yellow-600 dark:text-yellow-300 dark:bg-yellow-500/20 rounded-full text-sm">
                    Flutter
                </span>
                <span class="px-4 py-2 bg-pink-500/10 text-pink-600 dark:text-pink-300 dark:bg-pink-500/20 rounded-full text-sm">
                    UI/UX
                </span>
            </div>

        </div>

    </div>

</section>

</x-layout>
