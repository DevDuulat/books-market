@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8 max-w-2xl">

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg mb-8">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">
            Заказ №{{ $order->id }}
        </h1>

        <div class="space-y-2">
            <p class="text-lg font-semibold flex justify-between items-center">
                <span class="text-gray-600">Статус:</span>
                <span class="px-3 py-1 text-sm font-medium rounded-full
                             {{-- Классы для статуса можно настроить в зависимости от $order->status->label() --}}
                             @if($order->status->label() === 'Жаңы') bg-blue-100 text-blue-800
                             @elseif($order->status->label() === 'Жеткирүүдө') bg-yellow-100 text-yellow-800
                             @elseif($order->status->label() === 'Аткарылган') bg-green-100 text-green-800
                             @else bg-gray-100 text-gray-800 @endif">
                    {{ $order->status->label() }}
                </span>
            </p>

            <p class="text-xl font-bold flex justify-between items-center pt-2 border-t border-gray-100">
                <span class="text-gray-700">Бардыгы:</span>
                <span class="text-orange-500">{{ number_format($order->total, 0, ',', ' ') }} сом</span>
            </p>
        </div>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4 text-gray-800 border-b pb-3">
            Заказдагы товарлар
        </h2>

        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="text-sm text-gray-600 uppercase border-b">
                <th class="py-3 px-2 font-semibold">Товар</th>
                <th class="py-3 px-2 font-semibold text-center w-20">Саны</th>
                <th class="py-3 px-2 font-semibold text-right w-24">Баасы</th>
                <th class="py-3 px-2 font-semibold text-right w-24">Жалпы</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-b last:border-b-0 text-gray-700 hover:bg-gray-50">
                    <td class="py-3 px-2 font-medium">{{ $item->product->name ?? 'Товар' }}</td>
                    <td class="py-3 px-2 text-center">{{ $item->quantity }}</td>
                    <td class="py-3 px-2 text-right">{{ number_format($item->price, 0, ',', ' ') }}</td>
                    <td class="py-3 px-2 text-right font-semibold">{{ number_format($item->total, 0, ',', ' ') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection