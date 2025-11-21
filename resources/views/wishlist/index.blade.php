@extends('layouts.app')
@section('title', 'Избранное')

@section('content')
    <div class="container mx-auto mt-[80px] p-2 sm:p-4">
        <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Избранное</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($wishlists as $wishlist)
                @php
                    $product = $wishlist->product;
                @endphp

                <div
                        x-data="{ product: @js($product) }"
                        x-show="$store.wishlist.isIn(product.id)"
                        class="bg-white rounded-[16px] md:rounded-[24px] overflow-hidden flex flex-col p-2 md:p-3 relative shadow-xl hover:shadow-2xl transition border border-gray-100">

                    <button
                            @click.stop.prevent="$store.wishlist.toggle(product)"
                            :class="$store.wishlist.isIn(product.id) ? 'text-red-500' : 'text-gray-500'"
                            class="absolute top-2 right-2 md:top-4 md:right-4 bg-gray-100 rounded-full p-1 md:p-2 transition z-10"
                            :title="$store.wishlist.isIn(product.id) ? 'Удалить из избранного' : 'Добавить в избранное'">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>

                    <div class="h-40 md:h-64 w-full rounded-[10px] md:rounded-[16px] mb-2 overflow-hidden flex justify-center items-center bg-gray-50 p-2 md:p-4">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out"
                             alt="{{ $product->name }}"/>
                    </div>

                    <div class="flex flex-col text-gray-900 px-1">
                        <p class="text-base md:text-xl font-semibold whitespace-nowrap overflow-hidden text-ellipsis mb-1">{{ $product->name }}</p>

                        <div class="text-xs md:text-sm font-medium mb-2 md:mb-4 {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->quantity > 0 ? 'В наличии' : 'Нет в наличии' }}
                        </div>

                        <div class="flex items-end justify-between">
                            <div class="flex flex-col">
                                <p class="text-2xl md:text-4xl font-extrabold">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
                                @if($product->old_price)
                                    <p class="text-xs md:text-sm text-gray-400 line-through mt-0.5">{{ number_format($product->old_price, 0, '.', ' ') }} ₽</p>
                                @endif
                            </div>

                            <a href="#" class="bg-gray-200 text-gray-800 text-sm p-3 md:p-4 rounded-lg md:rounded-xl hover:bg-gray-300 transition whitespace-nowrap">
                                В корзину
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

        <div x-show="$store.wishlist.items.length === 0" class="col-span-full text-center text-gray-500 py-10">
            В избранном пока нет товаров.
        </div>

    </div>
@endsection