<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto px-6 sm:px-10">

        <a href="{{ route('login') }}" class="flex items-center text-sm text-orange-500 mt-6 mb-12">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Артка
        </a>

        <h2 class="text-2xl font-bold text-center mb-10">Электрондук почтаны ырастоо</h2>

        <div class="mb-8 text-sm text-gray-700 text-center">
            Катталганыңыз үчүн рахмат! Баштоодон мурун, биз сизге жөнөткөн шилтемени басуу менен электрондук почта дарегиңизди ырастай аласызбы? Эгер сиз электрондук почтаны албасаңыз, биз сизге дагы бир жолу кубануу менен жөнөтөбүз.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-8 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg text-center">
                Каттоо учурунда сиз берген электрондук почта дарегине жаңы ырастоо шилтемеси жөнөтүлдү.
            </div>
        @endif

        <div class="mt-10 flex flex-col space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-150 ease-in-out text-lg">
                    Ырастоо катын кайра жөнөтүү
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-sm text-orange-500 hover:text-orange-600 font-semibold focus:outline-none py-3">
                    Чыгуу
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>