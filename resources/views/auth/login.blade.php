<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full sm:max-w-md mx-auto px-6 sm:px-10">

        <a href="#" class="flex items-center text-sm text-orange-500 mt-6 mb-12">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Артка
        </a>

        <h2 class="text-2xl font-bold text-center mb-16">Кирүү</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="sr-only">Электрондук почта</label>
                <input id="email"
                       class="block w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-orange-500/50 rounded-lg px-4 py-3 placeholder-gray-600"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="Электрондук почта" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4 mb-3">
                <label for="password" class="sr-only">Сыр сөз</label>
                <input id="password"
                       class="block w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-orange-500/50 rounded-lg px-4 py-3 placeholder-gray-600"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="Сыр сөз" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            @if (Route::has('password.request'))
                <div class="flex justify-start mb-10">
                    <a class="text-sm text-orange-500 hover:text-orange-600 focus:outline-none" href="{{ route('password.request') }}">
                        Сыр сөздү унутуп калдыңызбы?
                    </a>
                </div>
            @endif

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-150 ease-in-out text-lg">
                Кирүү
            </button>
        </form>

        <div class="mt-16 text-center text-sm">
            @if (Route::has('register'))
                Каттоодон өтө элекмин,
                <a class="text-orange-500 hover:text-orange-600 font-semibold focus:outline-none" href="{{ route('register') }}">
                    Катталуу
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>