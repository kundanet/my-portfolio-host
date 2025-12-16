<x-layout>

<div class="min-h-screen flex flex-col items-center justify-start pt-20 px-4">

    {{-- Title --}}
    <h1 class="text-4xl font-extrabold tracking-wide text-center bg-clip-text 
               text-transparent bg-gradient-to-r from-blue-400 to-purple-400 mb-10"
        data-aos="fade-down">
        Contact Me
    </h1>

    {{-- Glass Card --}}
    <div data-aos="zoom-in"
        class="w-full max-w-xl p-10 rounded-2xl backdrop-blur-xl bg-white/10 dark:bg-gray-800/30
               shadow-2xl border border-white/20 dark:border-gray-700/40">

        <form method="POST" action="/contact">
            @csrf

            {{-- NAME FIELD --}}
            <div class="relative mb-8">
                <span class="absolute left-4 top-4 text-gray-400 dark:text-gray-300 text-xl">👤</span>

                <input type="text" name="name" required
                    class="peer w-full pl-12 p-4 rounded-xl bg-gray-900/30 dark:bg-gray-700/40
                           border border-gray-600 dark:border-gray-500
                           text-gray-100 dark:text-gray-200
                           focus:border-blue-500 dark:focus:border-blue-400
                           focus:ring-2 focus:ring-blue-600/40 
                           outline-none transition"
                    placeholder=" " />

                <label class="absolute left-12 top-4 text-gray-400 dark:text-gray-300
                           peer-placeholder-shown:top-4 peer-placeholder-shown:text-base
                           peer-focus:-top-3 peer-focus:text-sm peer-focus:text-blue-400
                           transition-all duration-200 px-1 bg-transparent">
                    Your Name
                </label>
            </div>

            {{-- EMAIL FIELD --}}
            <div class="relative mb-8">
                <span class="absolute left-4 top-4 text-gray-400 dark:text-gray-300 text-xl">📧</span>

                <input type="email" name="email" required
                    class="peer w-full pl-12 p-4 rounded-xl bg-gray-900/30 dark:bg-gray-700/40
                           border border-gray-600 dark:border-gray-500
                           text-gray-100 dark:text-gray-200
                           focus:border-blue-500 dark:focus:border-blue-400
                           focus:ring-2 focus:ring-blue-600/40 
                           outline-none transition"
                    placeholder=" " />

                <label class="absolute left-12 top-4 text-gray-400 dark:text-gray-300
                           peer-placeholder-shown:top-4 peer-placeholder-shown:text-base
                           peer-focus:-top-3 peer-focus:text-sm peer-focus:text-blue-400
                           transition-all duration-200 px-1 bg-transparent">
                    Your Email
                </label>
            </div>

            {{-- MESSAGE FIELD --}}
            <div class="relative mb-10">
                <span class="absolute left-4 top-4 text-gray-400 dark:text-gray-300 text-xl">💬</span>

                <textarea name="message" rows="5" required
                    class="peer w-full pl-12 p-4 rounded-xl bg-gray-900/30 dark:bg-gray-700/40
                           border border-gray-600 dark:border-gray-500
                           text-gray-100 dark:text-gray-200
                           focus:border-blue-500 dark:focus:border-blue-400
                           focus:ring-2 focus:ring-blue-600/40 
                           outline-none transition"
                    placeholder=" "></textarea>

                <label class="absolute left-12 top-4 text-gray-400 dark:text-gray-300
                           peer-placeholder-shown:top-4 peer-placeholder-shown:text-base
                           peer-focus:-top-3 peer-focus:text-sm peer-focus:text-blue-400
                           transition-all duration-200 px-1 bg-transparent">
                    Your Message
                </label>
            </div>

            {{-- SUBMIT BUTTON --}}
            <button
                class="w-full py-3 rounded-xl text-white font-semibold tracking-wide relative overflow-hidden
                       bg-gradient-to-r from-blue-500 to-purple-500
                       hover:opacity-90 transition shadow-lg">
                
                <span class="relative z-10">Send Message</span>

                {{-- Ripple Animation --}}
                <span class="absolute inset-0 bg-white opacity-0 rounded-xl scale-0 
                             transition duration-500 ease-out"
                      onclick="this.classList.add('opacity-20','scale-150')">
                </span>

            </button>

        </form>

    </div>

</div>

</x-layout>
