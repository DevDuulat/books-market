@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="text-sm text-gray-500 mb-8">
            <a href="#" class="hover:text-orange-500">Башкы бет</a>
            <span class="mx-2">&gt;</span>
            <a href="#" class="hover:text-orange-500">Корзина</a>
            <span class="mx-2">&gt;</span>
            <span class="text-gray-900 font-medium">Заказ берүү</span>
        </div>

        <h1 class="text-2xl font-bold mb-10">Заказ берүү</h1>

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-10">

                <div class="lg:w-2/3 space-y-8">

                    @php
                        $total_sum = 0;
                        $total_quantity = 0;
                    @endphp

                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total_sum += $subtotal;
                            $total_quantity += $item['quantity'];
                        @endphp

                        <div class="flex border-b border-gray-200 pb-8 last:border-b-0">
                            <div class="w-20 h-32 mr-6 flex-shrink-0">
                                @php
                                    $imagePath = isset($item['img']) && $item['img']
                                                 ? $item['img'] // URL уже полный
                                                 : asset('images/default_book.png');
                                @endphp

                                <img src="{{ $imagePath }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover rounded-lg transform hover:scale-105 transition duration-300"
                                     loading="lazy">
                            </div>

                            <div class="flex-grow">
                                <h3 class="text-lg font-bold mb-1">{{ $item['name'] }}</h3>

                                <p class="text-sm text-gray-700 mb-2 leading-snug">
                                    Бул китеп, жашоо жолун жакшы жагына тартууга, сага каалаган ар бир адам үчүн баалуу белек. Жашоодо-гу туура эмес адеп-ахлактарды оңдоого салым кошуп, бактылуу . . . Бул кит...
                                </p>

                                <div class="flex items-baseline space-x-3 mt-1">
                                    <span class="text-xl font-bold text-orange-500">{{ number_format($item['price'], 0, ',', ' ') }} сом</span>
                                    <span class="text-sm text-gray-400 line-through">1990 сом</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-baseline font-bold">
                            <span class="text-sm text-gray-800">Товарлардын саны</span>
                            <span class="text-3xl text-gray-900">{{ $total_quantity }}</span>
                        </div>
                        <div class="flex justify-between items-baseline font-bold mt-2">
                            <span class="text-sm text-gray-800">Бардыгы</span>
                            <span class="text-3xl text-orange-500">{{ number_format($total_sum, 0, ',', ' ') }} сом</span>
                        </div>
                    </div>

                </div>

                <div class="lg:w-1/3 p-6 bg-white ">
                    <h2 class="text-xl font-bold mb-6">Маалыматтар</h2>

                    <form id="checkoutForm" action="{{ route('checkout.confirm') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="sr-only">Аты-жөнүңүз</label>
                            <input type="text" required id="name" name="name"
                                   class="w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-0 rounded-lg px-4 py-3 placeholder-gray-500"
                                   value="{{ old('name') }}" placeholder="Аты-жөнүңүз">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="sr-only">Телефон номериңиз</label>
                            <input type="text" required id="phone" name="phone"
                                   class="w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-0 rounded-lg px-4 py-3 placeholder-gray-500"
                                   value="{{ old('phone') }}" placeholder="Телефон номериңиз">
                            @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="sr-only">Жеткирип берүү дарегиңиз</label>
                            <div class="relative">
                                <textarea id="address" name="address" required rows="4"
                                          class="w-full bg-gray-100 border-none focus:border-orange-500 focus:ring-0 rounded-lg px-4 pt-3 pb-8 placeholder-gray-500 resize-none"
                                          placeholder="Жеткирип берүү дарегиңиз">{{ old('address') }}</textarea>
                                <span class="absolute bottom-2 right-4 text-xs text-gray-400">0/00</span>
                            </div>
                            @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-150 ease-in-out text-lg mt-6">
                            Заказ берүү
                        </button>
                    </form>

                    <script>
                        document.getElementById('checkoutForm').addEventListener('submit', function() {
                            localStorage.removeItem('cartItems');
                        });
                    </script>
                </div>
            </div>
        @else
            <p class="text-center text-xl text-gray-600 mt-20">Корзина бош (Корзина пуста)</p>
        @endif
    </div>
@endsection