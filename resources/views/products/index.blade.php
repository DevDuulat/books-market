@extends('layouts.app')
@section('title', 'Главная страница')
@section('content')

    <div class="container mx-auto mt-[80px] p-4">

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-6 p-4">

            <div class="lg:col-span-12 col-span-12">
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6">

                    @forelse($products as $product)
                        <a href="{{ route('products.show', $product->slug) }}" class="block group" x-data="{ product: @js($product) }">
                            <div class="bg-white rounded-[24px] overflow-hidden flex flex-col p-3 relative shadow-xl group-hover:shadow-2xl transition border border-gray-100 h-full">

                                <button @click.stop.prevent="$store.wishlist.toggle(product)"
                                        :class="$store.wishlist.isIn(product.id) ? 'text-red-500' : 'text-gray-500'"
                                        class="absolute top-4 right-4 bg-gray-100 rounded-full p-2 transition z-10">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>

                                <div class="h-64 w-full rounded-[16px] mb-4 overflow-hidden flex justify-center items-center bg-gray-50 p-4">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out"
                                         alt="{{ $product->name }}"/>
                                </div>

                                <div class="flex flex-col text-gray-900 px-1 flex-grow">
                                    <p class="text-xl font-semibold mb-1 truncate" title="{{ $product->name }}">{{ $product->name }}</p>

                                    @php $isInStock = $product->quantity ?? 1; @endphp
                                    <div class="text-sm font-medium mb-4 @if($isInStock > 0) text-green-600 @else text-red-600 @endif">
                                        {{ $isInStock > 0 ? 'В наличии' : 'Нет в наличии' }}
                                    </div>

                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="flex flex-col">
                                            <p class="text-gray-900 text-4xl font-extrabold">{{ $product->price }}с</p>

                                            @if(isset($product->old_price) && $product->old_price > $product->price)
                                                <p class="text-gray-400 text-sm line-through mt-0.5">{{ $product->old_price }}с</p>
                                            @endif
                                        </div>

                                        <div>
                                            <button @click.prevent="$store.cart.add({
                                                id: {{ $product->id }},
                                                name: '{{ $product->name }}',
                                                price: {{ $product->price }},
                                                img: '{{ $product->image_url ?? '' }}'
                                            })"
                                                    class="bg-gray-200 text-gray-800 p-4 rounded-xl hover:bg-gray-300 transition">
                                                <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14 9.859L12.6077 8.46667L15.054 6H9V4H15.054L12.5873 1.53333L14 0.140999L18.859 5L14 9.859ZM7.53833 25.7437C6.89056 25.7437 6.33978 25.5167 5.886 25.0627C5.43222 24.6089 5.20533 24.0581 5.20533 23.4103C5.20533 22.7623 5.43222 22.2114 5.886 21.7577C6.33978 21.3039 6.89056 21.077 7.53833 21.077C8.18633 21.077 8.73722 21.3039 9.191 21.7577C9.64478 22.2114 9.87167 22.7623 9.87167 23.4103C9.87167 24.0581 9.64478 24.6089 9.191 25.0627C8.73722 25.5167 8.18633 25.7437 7.53833 25.7437ZM20.4617 25.7437C19.8137 25.7437 19.2628 25.5167 18.809 25.0627C18.3552 24.6089 18.1283 24.0581 18.1283 23.4103C18.1283 22.7623 18.3552 22.2114 18.809 21.7577C19.2628 21.3039 19.8137 21.077 20.4617 21.077C21.1094 21.077 21.6602 21.3039 22.114 21.7577C22.5678 22.2114 22.7947 22.7623 22.7947 23.4103C22.7947 24.0581 22.5678 24.6089 22.114 25.0627C21.6602 25.5167 21.1094 25.7437 20.4617 25.7437ZM0 2V0H3.81533L9.37933 11.7437H18.4693C18.5462 11.7437 18.6146 11.7244 18.6743 11.686C18.7341 11.6476 18.7854 11.5941 18.8283 11.5257L23.759 2.66667H26.0357L20.5793 12.523C20.3607 12.9077 20.0714 13.2072 19.7117 13.4217C19.3517 13.6363 18.9572 13.7437 18.5283 13.7437H8.8L7.25633 16.564C7.18789 16.6667 7.18578 16.7778 7.25 16.8973C7.314 17.0171 7.41011 17.077 7.53833 17.077H22.7947V19.077H7.53833C6.64944 19.077 5.97811 18.697 5.52433 17.937C5.07056 17.1772 5.05822 16.4084 5.48733 15.6307L7.38967 12.2103L2.53867 2H0Z" fill="black"/>
                                                </svg>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    @empty
                        <div class="lg:col-span-4 col-span-2 text-center py-10 text-gray-500">
                            Товары не найдены.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="p-4 lg:col-span-12">
            {{ $products->links() }}
        </div>

    </div>

@endsection
