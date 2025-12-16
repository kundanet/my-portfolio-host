<x-guest-layout>

<div class="relative w-full max-w-md">

    {{-- Glow --}}
    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r
                from-indigo-500 via-blue-500 to-purple-600
                blur opacity-30 animate-pulse"></div>

    {{-- Card --}}
    <div class="relative bg-white/10 backdrop-blur-xl rounded-3xl
                shadow-2xl p-10 border border-white/20">

        {{-- Icon --}}
        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center">
                <i data-lucide="shield" class="w-7 h-7 text-white"></i>
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl font-extrabold text-center mb-2">
            Admin Login
        </h1>
        <p class="text-center text-gray-300 mb-8">
            Welcome back, please sign in
        </p>

        {{-- ✅ Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 rounded-xl bg-red-500/20 border border-red-500/30 p-4 text-sm">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-300">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" reminding="false" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/20
                           focus:ring-2 focus:ring-indigo-500 outline-none text-white
                           placeholder-gray-300"
                    placeholder="admin@example.com"
                >
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/20
                           focus:ring-2 focus:ring-indigo-500 outline-none text-white"
                >
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between text-sm text-gray-300">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                           class="rounded bg-white/20 border-white/20">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}"
                   class="hover:text-white underline">
                    Forgot password?
                </a>
            </div>

            {{-- Button --}}
            <button
                class="w-full py-3 rounded-xl font-semibold text-lg
                       bg-gradient-to-r from-indigo-500 to-blue-600
                       hover:scale-[1.02] transition shadow-lg">
                Log In
            </button>
        </form>

        {{-- Back --}}
        <div class="mt-8 text-center">
            <a href="/" class="text-sm text-gray-400 hover:text-white">
                ← Back to Portfolio
            </a>
        </div>

    </div>
</div>

</x-guest-layout>
