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
                                                В корзину
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
