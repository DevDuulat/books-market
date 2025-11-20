@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="text-sm text-gray-500 mb-2">
            <a href="/" class="hover:underline">Башкы бет</a>
            <span class="mx-1">›</span>
            Менин заказдарым
        </div>

        <h1 class="text-3xl font-bold mb-6">
            Менин заказдарым
        </h1>

        @if($orders->count() === 0)
            <div class="bg-gray-100 p-6 rounded-lg text-center">
                Сизде азырынча заказдар жок.
            </div>
        @else

            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="bg-white border-b-2 border-gray-100 pb-5">

                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="text-xl font-bold text-orange-600 mb-1">
                                    Заказ №{{ $order->id }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </div>
                            </div>

                            <div class="text-sm px-4 py-1 rounded-md text-gray-800 font-medium
                            @if($order->status->value === 0) bg-yellow-300/50  {{-- Күтүү --}}
                            @elseif($order->status->value === 1) bg-blue-300/50   {{-- Иштеп чыгууда --}}
                            @elseif($order->status->value === 2) bg-green-300/50  {{-- Бүттү --}}
                            @elseif($order->status->value === 3) bg-red-300/50    {{-- Жокко чыгарылды --}}
                            @endif
                            ">
                                {{ $order->status->label() }}
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4 text-sm text-gray-500 mb-2 mt-6 border-b pb-1">
                            <div class="col-span-2">Товарлар</div>
                            <div class="text-center">Саны</div>
                            <div class="text-right">Баасы</div>
                        </div>

                        <div class="space-y-2">
                            @foreach($order->items as $item)
                                <div class="grid grid-cols-4 gap-4 text-base">
                                    <div class="col-span-2">
                                        {{ $item->product->name ?? 'Товар өчүрүлгөн' }}
                                    </div>
                                    <div class="text-center text-gray-700">
                                        {{ $item->quantity }}
                                    </div>
                                    <div class="text-right text-gray-700">
                                        {{ number_format($item->price, 0) }} сом
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-right mt-6 text-xl font-bold">
                            Бардыгы: <span class="text-orange-600">{{ number_format($order->total, 0) }} сом</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection