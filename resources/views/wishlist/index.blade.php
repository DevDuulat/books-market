@extends('layouts.app')
@section('title', 'Избранное')

@section('content')
    <div class="container mx-auto mt-[80px] p-4">
        <h1 class="text-2xl font-bold mb-6">Избранное</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($wishlists as $wishlist)
                @php
                    $product = $wishlist->product;
                @endphp

                <div
                        x-data="{ product: @js($product) }"
                        x-show="$store.wishlist.isIn(product.id)"
                        class="bg-white rounded-[24px] overflow-hidden flex flex-col p-3 relative shadow-xl hover:shadow-2xl transition max-w-sm border border-gray-100">
                    <button
                            @click.stop.prevent="$store.wishlist.toggle(product)"
                            :class="$store.wishlist.isIn(product.id) ? 'text-red-500' : 'text-gray-500'"
                            class="absolute top-4 right-4 bg-gray-100 rounded-full p-2 transition z-10"
                            :title="$store.wishlist.isIn(product.id) ? 'Удалить из избранного' : 'Добавить в избранное'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>


                    <div class="h-64 w-full rounded-[16px] mb-4 overflow-hidden flex justify-center items-center bg-gray-50 p-4">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out"/>
                    </div>

                    <div class="flex flex-col text-gray-900 px-1">
                        <p class="text-xl font-semibold whitespace-nowrap overflow-hidden text-ellipsis mb-1">{{ $product->name }}</p>
                        <div class="text-sm font-medium mb-4 {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->quantity > 0 ? 'В наличии' : 'Нет в наличии' }}
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <p class="text-gray-900 text-4xl font-extrabold">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
                                @if($product->old_price)
                                    <p class="text-gray-400 text-sm line-through mt-0.5">{{ number_format($product->old_price, 0, '.', ' ') }} ₽</p>
                                @endif
                            </div>

                            <a href="#" class="bg-gray-200 text-gray-800 p-4 rounded-xl hover:bg-gray-300 transition">
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