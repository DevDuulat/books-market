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
                    img: '{{ $product->images[0] ? asset('storage/' . $product->images[0]) : asset('assets/products/no-image.png') }}',
                    quantity: 1,
                };
                Alpine.store('cart').add(cartItem);
            }
        }
    }" class="container mx-auto mt-[40px] p-4">

        <div class="text-sm text-gray-500 px-2 sm:px-0 mb-4">
            <a href="/" class="hover:underline">Башкы бет</a>
            <span class="mx-1">›</span>
            @if(isset($product->category))
                <a href="{{ route('products.category', ['category' => $product->category->slug]) }}" class="hover:underline">
                    {{ $product->category->name }}
                </a>
                <span class="mx-1">›</span>
            @endif
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7 flex flex-col space-y-4">

                <div id="main-image-container" class="relative bg-white rounded-[24px] overflow-hidden p-3 flex items-center justify-center h-[350px] md:h-[550px] bg-gray-50 cursor-zoom-in shadow-sm">
                    <img id="main-product-image"
                         src="{{ asset('storage/' . $product->images[0]) }}"
                         alt="{{ $product->name }}"
                         class="max-h-full w-auto object-contain transition-transform duration-300 transform"
                         data-default-src="{{ asset('storage/' . $product->images[0]) }}">
                </div>

                <div class="flex flex-row overflow-x-auto space-x-3 pb-2 custom-scrollbar snap-x" id="thumbnail-list">
                    @foreach($product->images as $index => $image)
                        <div class="flex-shrink-0 snap-start">
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="Thumbnail {{ $index + 1 }}"
                                 data-image-src="{{ asset('storage/' . $image) }}"
                                 class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-xl cursor-pointer border-2 hover:border-[#FF9027] transition-all thumbnail-image
                                @if($index === 0) border-[#FF9027] active-thumbnail @else border-transparent @endif"
                                 onclick="changeMainImage(this)">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col space-y-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>
                    </div>

                    <div class="flex space-x-2">
                        <button
                                @click.stop.prevent="$store.wishlist.toggle(product)"
                                :class="$store.wishlist.isIn(product.id) ? 'text-white bg-red-500' : 'text-[#FF9027] bg-[#FFF4E9]'"
                                class="p-3 rounded-xl transition-colors shadow-sm"
                        >
                            <svg width="20" height="20" viewBox="0 0 19 17" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.7373 1C14.8652 1 15.7614 1.36915 16.4941 2.10156C17.2266 2.83379 17.5956 3.7293 17.5957 4.85645C17.5957 5.3676 17.5179 5.8746 17.3584 6.37988L17.2852 6.5957C17.0832 7.15371 16.7074 7.82081 16.1191 8.59961C15.6783 9.18325 15.1109 9.84138 14.4131 10.5762L13.6719 11.3369C12.621 12.3881 11.2813 13.6506 9.65039 15.127L9.29785 15.4453L8.94531 15.127C7.31882 13.65 5.98026 12.387 4.92676 11.3359C4.00859 10.4198 3.27154 9.60754 2.70801 8.89746L2.47754 8.59961L2.2666 8.3125C1.79773 7.65548 1.48725 7.08467 1.31055 6.59668C1.10157 6.01948 1 5.44113 1 4.8584C1.00008 3.73046 1.37004 2.83504 2.10254 2.10254C2.8353 1.36984 3.73067 1.00002 4.8584 1C5.55545 1 6.20917 1.16319 6.83301 1.49512C7.45251 1.82486 8.00538 2.31049 8.48828 2.97656L9.28516 4.0752L10.0986 2.98926C10.6042 2.31411 11.1665 1.82336 11.7803 1.49219C12.39 1.16319 13.0374 1.00003 13.7373 1Z" stroke-width="2"/>
                            </svg>
                        </button>

                        <button
                                class="p-3 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition"
                                @click="if(navigator.share){
                                navigator.share({ title: '{{ $product->name }}', url: window.location.href });
                            } else {
                                prompt('Шилтемени көчүрүү:', window.location.href);
                            }"
                        >
                            <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 11.5858C7.44772 11.5858 7 11.1381 7 10.5858V3.43582L5.12511 5.31071C4.72672 5.7091 4.07906 5.70342 3.68772 5.2981C3.30597 4.90271 3.31148 4.27434 3.70011 3.88571L7.2929 0.292921C7.68342 -0.0976031 8.31658 -0.0976022 8.70711 0.292922L12.2999 3.88571C12.6885 4.27434 12.694 4.90271 12.3123 5.2981C11.9209 5.70342 11.2733 5.7091 10.8749 5.31071L9 3.43582V10.5858C9 11.1381 8.55229 11.5858 8 11.5858ZM2 15.5858C1.45 15.5858 0.979167 15.39 0.5875 14.9983C0.195833 14.6066 0 14.1358 0 13.5858V11.5858C0 11.0335 0.447715 10.5858 1 10.5858C1.55228 10.5858 2 11.0335 2 11.5858V13.5858H14V11.5858C14 11.0335 14.4477 10.5858 15 10.5858C15.5523 10.5858 16 11.0335 16 11.5858V13.5858C16 14.1358 15.8042 14.6066 15.4125 14.9983C15.0208 15.39 14.55 15.5858 14 15.5858H2Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <p class="text-gray-600 text-base leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="py-6 border-t border-b border-gray-100">
                    <div class="flex items-baseline space-x-3">
                        <span class="text-4xl font-extrabold text-[#FF9027]">
                            {{ number_format($product->price, 0, '.', ' ') }}с
                        </span>
                        @if(isset($product->discount) && $product->discount > 0)
                            <span class="text-xl text-gray-400 line-through">
                                {{ number_format($product->price + $product->discount, 0, '.', ' ') }}с
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center mt-3">
                        <div class="w-2 h-2 rounded-full mr-2" :class="product.quantity > 0 ? 'bg-green-500' : 'bg-red-500'"></div>
                        <span class="text-sm font-medium" :class="product.quantity > 0 ? 'text-green-600' : 'text-red-600'"
                              x-text="product.quantity > 0 ? 'Кампада бар' : 'Кампада жок'">
                        </span>
                    </div>
                </div>

                <button @click.prevent="addToCart(product)"
                        :disabled="product.quantity <= 0"
                        class="w-full p-4 rounded-2xl transition-all flex items-center justify-center space-x-3 text-lg font-bold shadow-lg shadow-orange-100"
                        :class="product.quantity > 0 ? 'bg-[#FF9027] text-white hover:bg-[#e67e1a]' : 'bg-gray-200 text-gray-400 cursor-not-allowed'">

                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-text="product.quantity > 0 ? 'Себетке кошуу' : 'Кампада жок'"></span>
                </button>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #FF9027;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .custom-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .custom-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainImageContainer = document.getElementById('main-image-container');
            const mainImage = document.getElementById('main-product-image');

            // Зум эффекти ГАНА десктоп үчүн (экран 1024px чоң болсо)
            const enableZoom = () => {
                if (window.innerWidth > 1024) {
                    mainImageContainer.addEventListener('mousemove', handleMouseMove);
                    mainImageContainer.addEventListener('mouseleave', handleMouseLeave);
                    mainImageContainer.classList.add('cursor-zoom-in');
                } else {
                    // Мобилдикте окуяларды (events) өчүрүү
                    mainImageContainer.removeEventListener('mousemove', handleMouseMove);
                    mainImageContainer.removeEventListener('mouseleave', handleMouseLeave);
                    mainImageContainer.classList.remove('cursor-zoom-in');
                    mainImage.style.transform = 'scale(1)'; // Зумду баштапкы абалга келтирүү
                }
            };

            function handleMouseMove(e) {
                const rect = mainImageContainer.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                mainImage.style.transformOrigin = `${x}% ${y}%`;
                mainImage.style.transform = `scale(2.0)`;
            }

            function handleMouseLeave() {
                mainImage.style.transform = 'scale(1)';
            }

            // Барак жүктөлгөндө текшерүү
            enableZoom();

            // Экрандын өлчөмү өзгөргөндө текшерүү (мисалы, планшетти бурса)
            window.addEventListener('resize', enableZoom);
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

            mainImage.style.opacity = '0.3';
            setTimeout(() => {
                mainImage.src = newSrc;
                mainImage.onload = () => {
                    mainImage.style.opacity = '1';
                };
            }, 150);
        }
    </script>
@endsection