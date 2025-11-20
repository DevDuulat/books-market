@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Оформление заказа</h1>

        @if(count($cart) > 0)
            <table class="w-full border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Название</th>
                    <th class="p-2 border">Количество</th>
                    <th class="p-2 border">Цена</th>
                    <th class="p-2 border">Итого</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td class="p-2 border">{{ $item['name'] }}</td>
                        <td class="p-2 border">{{ $item['quantity'] }}</td>
                        <td class="p-2 border">{{ number_format($item['price'], 2) }}</td>
                        <td class="p-2 border">{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-right font-bold text-lg">
                Итого: {{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) }}
            </div>

            <form id="checkoutForm"  action="{{ route('checkout.confirm') }}" method="POST" class="mt-8 max-w-lg space-y-5">
                @csrf

                <div>
                    <label class="block font-semibold mb-1">Ваше имя</label>
                    <input type="text" name="name" required
                           class="w-full border rounded-lg px-4 py-2"
                           value="{{ old('name') }}">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Телефон</label>
                    <input type="text" name="phone" required
                           class="w-full border rounded-lg px-4 py-2"
                           value="{{ old('phone') }}">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Адрес доставки</label>
                    <textarea name="address" required
                              class="w-full border rounded-lg px-4 py-2 h-24">{{ old('address') }}</textarea>
                </div>

                <button type="submit"
                        class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition w-full font-semibold">
                    Подтвердить заказ
                </button>
            </form>
            <script>
                document.getElementById('checkoutForm').addEventListener('submit', function() {
                    localStorage.removeItem('cartItems');
                });
            </script>
        @else
            <p>Корзина пуста</p>
        @endif
    </div>
@endsection
