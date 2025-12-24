<div class="container mx-auto mt-[24px] p-2 sm:p-4">
    @foreach($categoriesWithProducts as $group)
        <div class="mb-12">
            <div class="flex items-end justify-between mb-6 px-2 sm:px-0">
                <div class="flex flex-col">
                    <a href="{{ route('products.category', $group['slug']) }}" class="group inline-flex items-center space-x-2">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 group-hover:text-orange-500 transition">
                            {{ $group['name'] }}
                        </h2>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-orange-500 transition translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <a href="{{ route('products.category', $group['slug']) }}" class="text-sm font-semibold text-orange-500 hover:text-orange-600 transition border-b border-orange-200 hover:border-orange-500 pb-0.5">
                    Баардыгын көрүү
                </a>
            </div>

            <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4 md:gap-4 px-2 sm:px-0">
                @foreach($group['products'] as $product)
                    <div class="relative flex" x-data="{ product: @js($product) }">
                        <a href="{{ route('products.show', $product['slug']) }}"
                           class="flex flex-col group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-xl border border-gray-100 transition hover:shadow-lg sm:hover:shadow-2xl relative p-2 sm:p-3 w-full">

                            <button @click.stop.prevent="$store.wishlist.toggle(product)"
                                    :class="$store.wishlist.isIn(product.id) ? 'text-[#FF2E17] bg-[#FFF4E9]' : 'text-[#FF9027] bg-[#FFF4E9]'"
                                    class="absolute top-2 right-2 rounded-[12px] p-1 transition z-10">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>

                            <div class="h-40 sm:h-48 w-full flex justify-center items-center bg-gray-50 p-2 sm:p-4 overflow-hidden rounded-lg sm:rounded-xl mb-2 sm:mb-4">
                                <img src="{{ $product['img'] }}"
                                     class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out group-hover:scale-105"
                                     alt="{{ $product['name'] }}">
                            </div>

                            <div class="flex flex-col text-gray-900 flex-grow px-0.5 sm:px-1">
                                <p class="text-base sm:text-lg font-semibold mb-0.5 truncate" title="{{ $product['name'] }}">
                                    {{ $product['name'] }}
                                </p>

                                <div class="text-xs sm:text-sm font-medium mb-2 {{ $product['quantity'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product['quantity'] > 0 ? 'Кампада' : 'Кампада жок' }}
                                </div>

                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex flex-col leading-none">
                                        <p class="text-[#FF9027] text-xl sm:text-3xl font-extrabold">
                                            {{ number_format($product['price'], 0, '', ' ') }}с
                                        </p>

                                        @if($product['old_price'] > $product['price'])
                                            <p class="text-gray-400 text-xs sm:text-sm line-through mt-0.5">
                                                {{ number_format($product['old_price'], 0, '', ' ') }}с
                                            </p>
                                        @endif
                                    </div>

                                    <button @click.prevent="$store.cart.add(product)"
                                            class="bg-gray-200 text-gray-800 p-2 sm:p-3 rounded-lg sm:rounded-xl hover:bg-gray-300 transition">
                                        <svg width="20" height="19" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 9.859L12.6077 8.46667L15.054 6H9V4H15.054L12.5873 1.53333L14 0.140999L18.859 5L14 9.859ZM7.53833 25.7437C6.89056 25.7437 6.33978 25.5167 5.886 25.0627C5.43222 24.6089 5.20533 24.0581 5.20533 23.4103C5.20533 22.7623 5.43222 22.2114 5.886 21.7577C6.33978 21.3039 6.89056 21.077 7.53833 21.077C8.18633 21.077 8.73722 21.3039 9.191 21.7577C9.64478 22.2114 9.87167 22.7623 9.87167 23.4103C9.87167 24.0581 9.64478 24.6089 9.191 25.0627C8.73722 25.5167 8.18633 25.7437 7.53833 25.7437ZM20.4617 25.7437C19.8137 25.7437 19.2628 25.5167 18.809 25.0627C18.3552 24.6089 18.1283 24.0581 18.1283 23.4103C18.1283 22.7623 18.3552 22.2114 18.809 21.7577C19.2628 21.3039 19.8137 21.077 20.4617 21.077C21.1094 21.077 21.6602 21.3039 22.114 21.7577C22.5678 22.2114 22.7947 22.7623 22.7947 23.4103C22.7947 24.0581 22.5678 24.6089 22.114 25.0627C21.6602 25.5167 21.1094 25.7437 20.4617 25.7437ZM0 2V0H3.81533L9.37933 11.7437H18.4693C18.5462 11.7437 18.6146 11.7244 18.6743 11.686C18.7341 11.6476 18.7854 11.5941 18.8283 11.5257L23.759 2.66667H26.0357L20.5793 12.523C20.3607 12.9077 20.0714 13.2072 19.7117 13.4217C19.3517 13.6363 18.9572 13.7437 18.5283 13.7437H8.8L7.25633 16.564C7.18789 16.6667 7.18578 16.7778 7.25 16.8973C7.314 17.0171 7.41011 17.077 7.53833 17.077H22.7947V19.077H7.53833C6.64944 19.077 5.97811 18.697 5.52433 17.937C5.07056 17.1772 5.05822 16.4084 5.48733 15.6307L7.38967 12.2103L2.53867 2H0Z" fill="black"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>