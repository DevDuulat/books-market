@extends('layouts.app')
@section('title', $product->name)

@section('content')
    <div x-data="{
        product: {{ Js::from($product) }},
        addToCart(product) {
            if (product.quantity > 0) {
                const cartItem = {
                    id: product.id,
                    name: product.name,
                    slug: product.slug,
                    price: product.price,
                    old_price: product.old_price || 0,
                    img: '{{ $product->images[0] ? asset('storage/' . $product->images[0]) : asset('assets/products/no-image.png') }}', // Используем первое изображение
                    quantity: product.quantity,
                };

                Alpine.store('cart').add(cartItem);
                console.log('Товар добавлен в корзину:', cartItem);
            } else {
                console.warn('Товар отсутствует на складе.');
            }
        }
    }" class="container mx-auto mt-[40px] p-4">
        <div class="text-sm text-gray-500 px-2 sm:px-0">
            <a href="/" class="hover:underline">Башкы бет</a>
            <span class="mx-1">›</span>

            @if(isset($product->category))
                <a href="{{ route('products.category', ['category' => $product->category->slug]) }}" class="hover:underline">
                    {{ $product->category->name }}
                </a>
                <span class="mx-1">›</span>
            @endif

            <span class="text-gray-900 font-medium">
        {{ $product->name }}
    </span>
        </div>

        <h1 class="text-2xl font-bold mb-6 px-2 sm:px-0">
            {{ $product->name }}
        </h1>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="hidden lg:flex flex-col space-y-4 lg:col-span-1">

                <button title="Предыдущее изображение" class="bg-[#FFF4E9] p-2 rounded-full text-gray-600 transition flex items-center justify-center hover:bg-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>

                <div class="space-y-3" id="thumbnail-list">
                    @foreach($product->images as $index => $image)
                        <img src="{{ asset('storage/' . $image) }}"
                             alt="Thumbnail {{ $index + 1 }}"
                             data-image-src="{{ asset('storage/' . $image) }}"
                             class="w-full h-24 object-cover rounded-lg cursor-pointer border-2 hover:border-[#FF9027] transition thumbnail-image
                            @if($index === 0) border-[#FF9027] active-thumbnail @else border-transparent @endif"
                             onclick="changeMainImage(this)">
                    @endforeach
                </div>

                <button title="Следующее изображение" class="bg-[#FFF4E9] p-2 rounded-full text-gray-600 transition flex items-center justify-center hover:bg-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div class="lg:col-span-11 flex flex-col md:flex-row gap-8">

                <div class="w-full md:w-3/5 lg:w-3/5 relative bg-white rounded-[24px] overflow-hidden p-3 flex items-center justify-center h-[500px]">

                    <div id="main-image-container" class="h-full w-full rounded-[16px] overflow-hidden flex justify-center items-center bg-gray-50 relative cursor-zoom-in">
                        <img id="main-product-image"
                             src="{{ asset('storage/' . $product->images[0]) }}"
                             alt="{{ $product->name }}"
                             class="max-h-full w-auto object-contain transition-transform duration-300 transform"
                             data-default-src="{{ asset('storage/' . $product->images[0]) }}">
                    </div>

                </div>

                <div class="w-full md:w-2/5 flex flex-col space-y-6">

                    <div class="flex justify-end space-x-3">
                        {{-- Кнопка "В избранное" использует доступный объект product --}}
                        <div x-data>
                            <button
                                    @click.stop.prevent="$store.wishlist.toggle(product)"
                                    :class="$store.wishlist.isIn(product.id) ? 'text-red-500 bg-red-100' : 'text-gray-500 bg-gray-100'"
                                    class="p-3 rounded-full transition"
                                    title="Сохранить в избранное"
                            >
                                <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7373 1C14.8652 1 15.7614 1.36915 16.4941 2.10156C17.2266 2.83379 17.5956 3.7293 17.5957 4.85645C17.5957 5.3676 17.5179 5.8746 17.3584 6.37988L17.2852 6.5957C17.0832 7.15371 16.7074 7.82081 16.1191 8.59961C15.6783 9.18325 15.1109 9.84138 14.4131 10.5762L13.6719 11.3369C12.621 12.3881 11.2813 13.6506 9.65039 15.127L9.29785 15.4453L8.94531 15.127C7.31882 13.65 5.98026 12.387 4.92676 11.3359C4.00859 10.4198 3.27154 9.60754 2.70801 8.89746L2.47754 8.59961L2.2666 8.3125C1.79773 7.65548 1.48725 7.08467 1.31055 6.59668C1.10157 6.01948 1 5.44113 1 4.8584C1.00008 3.73046 1.37004 2.83504 2.10254 2.10254C2.8353 1.36984 3.73067 1.00002 4.8584 1C5.55545 1 6.20917 1.16319 6.83301 1.49512C7.45251 1.82486 8.00538 2.31049 8.48828 2.97656L9.28516 4.0752L10.0986 2.98926C10.6042 2.31411 11.1665 1.82336 11.7803 1.49219C12.39 1.16319 13.0374 1.00003 13.7373 1Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Кнопка "Поделиться" (без изменения) --}}
                        <div x-data="{ productUrl: '{{ route('products.show', $product->slug) }}' }">
                            <button
                                    title="Поделиться"
                                    class="p-3 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition"
                                    @click="if(navigator.share){
                                           navigator.share({ title: '{{ $product->name }}', url: productUrl });
                                       } else {
                                           prompt('Скопируйте ссылку', productUrl);
                                       }"
                            >
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 11.5858C7.44772 11.5858 7 11.1381 7 10.5858V3.43582L5.12511 5.31071C4.72672 5.7091 4.07906 5.70342 3.68772 5.2981C3.30597 4.90271 3.31148 4.27434 3.70011 3.88571L7.2929 0.292921C7.68342 -0.0976031 8.31658 -0.0976022 8.70711 0.292922L12.2999 3.88571C12.6885 4.27434 12.694 4.90271 12.3123 5.2981C11.9209 5.70342 11.2733 5.7091 10.8749 5.31071L9 3.43582V10.5858C9 11.1381 8.55229 11.5858 8 11.5858ZM2 15.5858C1.45 15.5858 0.979167 15.39 0.5875 14.9983C0.195833 14.6066 0 14.1358 0 13.5858V11.5858C0 11.0335 0.447715 10.5858 1 10.5858C1.55228 10.5858 2 11.0335 2 11.5858V13.5858H14V11.5858C14 11.0335 14.4477 10.5858 15 10.5858C15.5523 10.5858 16 11.0335 16 11.5858V13.5858C16 14.1358 15.8042 14.6066 15.4125 14.9983C15.0208 15.39 14.55 15.5858 14 15.5858H2Z" fill="#646464"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900">{{ $product->name }}</h1>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    </div>

                    <div class="py-4 border-t border-b border-gray-100">
                        <div class="flex items-baseline space-x-3">
                            {{-- Используем PHP-функцию number_format для форматирования цены --}}
                            <span class="text-4xl font-extrabold text-[#FF9027]">{{ number_format($product->price, 0, '.', ' ') }}с</span>

                            @if(isset($product->discount) && $product->discount > 0)
                                <span class="text-xl text-gray-400 line-through">
                                    {{ number_format($product->price + $product->discount, 0, '.', ' ') }}с
                                </span>
                            @endif
                        </div>
                        <div class="text-base font-medium mt-2"
                             :class="product.quantity > 0 ? 'text-green-600' : 'text-red-600'"
                             x-text="product.quantity > 0 ? 'В наличии' : 'Нет в наличии'">
                        </div>
                    </div>

                    {{-- === ИЗМЕНЕННАЯ КНОПКА КОРЗИНЫ === --}}
                    <button @click.prevent="addToCart(product)"
                            :disabled="product.quantity <= 0"
                            :class="{
                                'bg-gray-200 hover:bg-gray-300 text-gray-800': product.quantity > 0,
                                'bg-gray-100 text-gray-500 cursor-not-allowed opacity-70': product.quantity <= 0
                            }"
                            class="p-4 rounded-xl transition flex items-center justify-center space-x-2">

                        <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 27 26" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 9.859L12.6077 8.46667L15.054 6H9V4H15.054L12.5873 1.53333L14 0.140999L18.859 5L14 9.859ZM7.53833 25.7437C6.89056 25.7437 6.33978 25.5167 5.886 25.0627C5.43222 24.6089 5.20533 24.0581 5.20533 23.4103C5.20533 22.7623 5.43222 22.2114 5.886 21.7577C6.33978 21.3039 6.89056 21.077 7.53833 21.077C8.18633 21.077 8.73722 21.3039 9.191 21.7577C9.64478 22.2114 9.87167 22.7623 9.87167 23.4103C9.87167 24.0581 9.64478 24.6089 9.191 25.0627C8.73722 25.5167 8.18633 25.7437 7.53833 25.7437ZM20.4617 25.7437C19.8137 25.7437 19.2628 25.5167 18.809 25.0627C18.3552 24.6089 18.1283 24.0581 18.1283 23.4103C18.1283 22.7623 18.3552 22.2114 18.809 21.7577C19.2628 21.3039 19.8137 21.077 20.4617 21.077C21.1094 21.077 21.6602 21.3039 22.114 21.7577C22.5678 22.2114 22.7947 22.7623 22.7947 23.4103C22.7947 24.0581 22.5678 24.6089 22.114 25.0627C21.6602 25.5167 21.1094 25.7437 20.4617 25.7437ZM0 2V0H3.81533L9.37933 11.7437H18.4693C18.5462 11.7437 18.6146 11.7244 18.6743 11.686C18.7341 11.6476 18.7854 11.5941 18.8283 11.5257L23.759 2.66667H26.0357L20.5793 12.523C20.3607 12.9077 20.0714 13.2072 19.7117 13.4217C19.3517 13.6363 18.9572 13.7437 18.5283 13.7437H8.8L7.25633 16.564C7.18789 16.6667 7.18578 16.7778 7.25 16.8973C7.314 17.0171 7.41011 17.077 7.53833 17.077H22.7947V19.077H7.53833C6.64944 19.077 5.97811 18.697 5.52433 17.937C5.07056 17.1772 5.05822 16.4084 5.48733 15.6307L7.38967 12.2103L2.53867 2H0Z"
                                  fill="currentColor"/>
                        </svg>
                        <span x-text="product.quantity > 0 ? 'В корзину' : 'Нет в наличии'"></span>
                    </button>
                    {{-- =================================== --}}

                </div>
            </div>
        </div>
    </div>

    {{-- Весь ваш JavaScript (без изменений) --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const mainImageContainer = document.getElementById('main-image-container');
            const mainImage = document.getElementById('main-product-image');

            mainImageContainer.addEventListener('mousemove', (e) => {
                const rect = mainImageContainer.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const xPercent = (x / rect.width) * 100;
                const yPercent = (y / rect.height) * 100;
                mainImage.style.transform = `scale(2.0)`;
                mainImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            });

            mainImageContainer.addEventListener('mouseleave', () => {
                mainImage.style.transform = 'scale(1)';
                mainImage.style.transformOrigin = 'center center';
            });
        });

        function changeMainImage(thumbnailElement) {
            const newSrc = thumbnailElement.getAttribute('data-image-src');
            const mainImage = document.getElementById('main-product-image');

            document.querySelectorAll('.thumbnail-image').forEach(img => {
                img.classList.remove('border-[#FF9027]', 'active-thumbnail');
                img.classList.add('border-transparent');
            });
            thumbnailElement.classList.add('border-[#FF9027]', 'active-thumbnail');
            thumbnailElement.classList.remove('border-transparent');

            mainImage.style.opacity = '0.7';
            setTimeout(() => {
                mainImage.src = newSrc;
                mainImage.onload = () => {
                    mainImage.style.opacity = '1';
                };
            }, 100);
        }
    </script>
@endsection