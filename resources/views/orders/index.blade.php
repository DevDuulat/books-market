@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="text-sm text-gray-500 mb-2">
            <a href="/" class="hover:underline">Башкы бет</a>
            <span class="mx-1">›</span>
            Менин заказдарым
        </div>

        <h1 class="text-3xl font-bold mb-8">
            Менин заказдарым
        </h1>

        @if($orders->count() === 0)
            <div class="bg-white p-10 rounded-xl shadow-lg text-center border border-gray-200">
                <p class="text-xl font-semibold mb-4 text-gray-700">Сизде азырынча заказдар жок.</p>
                <p class="text-gray-500 mb-6">Дүкөнгө өтүп, биринчи заказыңызды жасаңыз.</p>
                <a href="/shop" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150">
                    Дүкөнгө өтүү
                </a>
            </div>
        @else

            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">

                        <div class="flex justify-between items-start border-b pb-4 mb-4">
                            <div>
                                <div class="text-2xl font-extrabold text-orange-600 mb-1">
                                    Заказ №{{ $order->id }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d.m.Y') }}
                                    <span class="text-xs ml-1">({{ $order->created_at->format('H:i') }})</span>
                                </div>
                            </div>

                            @php
                                $status = $order->status->value;
                                $statusClass = match($status) {
                                    0 => 'bg-yellow-400/70',   // Новый
                                    1 => 'bg-green-400/70',    // Завершён
                                    2 => 'bg-red-400/70',      // Отменён
                                    default => 'bg-gray-300', // На будущее
                                };
                            @endphp

                            <div class="text-sm px-3 py-1 rounded-full text-gray-900 font-semibold uppercase tracking-wider {{ $statusClass }}">
                                {{ $order->status->label() }}
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4 text-xs font-semibold text-gray-500 mb-3 border-b pb-1">
                            <div class="col-span-2">ТОВАРЛАР</div>
                            <div class="text-center">САНЫ</div>
                            <div class="text-right">БИРДИК БААСЫ</div>
                        </div>

                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="grid grid-cols-4 gap-4 text-sm items-center">
                                    <div class="col-span-2 font-medium text-gray-800">
                                        {{ $item->product->name ?? 'Товар өчүрүлгөн' }}
                                    </div>
                                    <div class="text-center text-gray-600">
                                        {{ $item->quantity }} даана
                                    </div>
                                    <div class="text-right text-gray-600">
                                        {{ number_format($item->price, 0) }} сом
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-right mt-6 pt-4 border-t border-dashed">
                            <span class="text-lg font-semibold text-gray-800">Бардыгы:</span>
                            <span class="text-2xl font-extrabold text-orange-600 ml-2">{{ number_format($order->total, 0) }} сом</span>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
