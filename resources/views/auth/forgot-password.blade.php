<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto px-6 sm:px-10">

        <a href="{{ route('login') }}" class="flex items-center text-sm text-orange-500 mt-6 mb-12">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Артка
        </a>

        <h2 class="text-2xl font-bold text-center mb-10">Сыр сөздү унутуу</h2>

        <div class="mb-8 text-sm text-gray-700 text-center">
            Сыр сөзүңүздү унуттуңузбу? Маселе эмес. Бизге электрондук почта дарегиңизди айтыңыз, ошондо биз сизге жаңысын тандоого мүмкүндүк берген сыр сөздү калыбына келтирүү шилтемесин жөнөтөбүз.
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-10">
                <label for="email" class="sr-only">Электрондук почта</label>
                <input id="email"
                       class="block w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-orange-500/50 rounded-lg px-4 py-3 placeholder-gray-600"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       placeholder="Электрондук почта" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-150 ease-in-out text-lg">
                    Шилтемени жөнөтүү
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>