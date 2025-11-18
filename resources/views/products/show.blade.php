@extends('layouts.app')
@section('title', $product->name)

@section('content')
    <div  class="container mx-auto mt-[80px] p-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="hidden lg:flex flex-col space-y-4 lg:col-span-1">

                <button class="bg-[#FFF4E9] p-2 rounded-full text-gray-600 transition flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>

                <div class="space-y-3">
                    @foreach($product->images as $index => $image)
                        <img src="{{ asset('storage/' . $image) }}"
                             alt="Thumbnail {{ $index + 1 }}"
                             class="w-full h-24 object-cover rounded-lg cursor-pointer border-2 hover:border-blue-500 transition
                        @if($index === 0) border-blue-500 @else border-transparent @endif"
                             onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                    @endforeach
                </div>

                <button class="bg-[#FFF4E9] p-2 rounded-full text-gray-600 transition flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

            </div>

            <div class="lg:col-span-11 flex flex-col md:flex-row gap-8">

                <div class="w-full md:w-3/5 lg:w-3/5 relative bg-gray-50 rounded-xl overflow-hidden shadow-lg flex items-center justify-center p-4 h-96">
                    <img id="main-product-image"
                         src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="max-h-full w-auto object-contain transition-opacity duration-300">
                </div>

                <div class="w-full md:w-2/5 lg:w-2/5 flex flex-col space-y-6">

                    <div class="flex justify-end space-x-3">
                        <button title="Сохранить в избранное" class="p-3 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-500 transition">
                            <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.7373 1C14.8652 1 15.7614 1.36915 16.4941 2.10156C17.2266 2.83379 17.5956 3.7293 17.5957 4.85645C17.5957 5.3676 17.5179 5.8746 17.3584 6.37988L17.2852 6.5957C17.0832 7.15371 16.7074 7.82081 16.1191 8.59961C15.6783 9.18325 15.1109 9.84138 14.4131 10.5762L13.6719 11.3369C12.621 12.3881 11.2813 13.6506 9.65039 15.127L9.29785 15.4453L8.94531 15.127C7.31882 13.65 5.98026 12.387 4.92676 11.3359C4.00859 10.4198 3.27154 9.60754 2.70801 8.89746L2.47754 8.59961L2.2666 8.3125C1.79773 7.65548 1.48725 7.08467 1.31055 6.59668C1.10157 6.01948 1 5.44113 1 4.8584C1.00008 3.73046 1.37004 2.83504 2.10254 2.10254C2.8353 1.36984 3.73067 1.00002 4.8584 1C5.55545 1 6.20917 1.16319 6.83301 1.49512C7.45251 1.82486 8.00538 2.31049 8.48828 2.97656L9.28516 4.0752L10.0986 2.98926C10.6042 2.31411 11.1665 1.82336 11.7803 1.49219C12.39 1.16319 13.0374 1.00003 13.7373 1Z" stroke="#646464" stroke-width="2"/>
                            </svg>

                        </button>
                        <button title="Поделиться" class="p-3 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 11.5858C7.44772 11.5858 7 11.1381 7 10.5858V3.43582L5.12511 5.31071C4.72672 5.7091 4.07906 5.70342 3.68772 5.2981C3.30597 4.90271 3.31148 4.27434 3.70011 3.88571L7.2929 0.292921C7.68342 -0.0976031 8.31658 -0.0976022 8.70711 0.292922L12.2999 3.88571C12.6885 4.27434 12.694 4.90271 12.3123 5.2981C11.9209 5.70342 11.2733 5.7091 10.8749 5.31071L9 3.43582V10.5858C9 11.1381 8.55229 11.5858 8 11.5858ZM2 15.5858C1.45 15.5858 0.979167 15.39 0.5875 14.9983C0.195833 14.6066 0 14.1358 0 13.5858V11.5858C0 11.0335 0.447715 10.5858 1 10.5858C1.55228 10.5858 2 11.0335 2 11.5858V13.5858H14V11.5858C14 11.0335 14.4477 10.5858 15 10.5858C15.5523 10.5858 16 11.0335 16 11.5858V13.5858C16 14.1358 15.8042 14.6066 15.4125 14.9983C15.0208 15.39 14.55 15.5858 14 15.5858H2Z" fill="#646464"/>
                            </svg>
                        </button>
                    </div>

                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900">{{ $product->name }}</h1>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    </div>

                    <div class="py-4 border-t border-b border-gray-100">
                        <div class="flex items-baseline space-x-3">
                            <span class="text-4xl font-extrabold text-gray-900">{{ $product->price }}с</span>

                            @if($product->discount > 0)
                                <span class="text-xl text-gray-400 line-through">{{ $product->old_price }}с</span>
                            @endif
                        </div>
                    </div>

                    <button onclick="addToCart({{ $product->id }})"
                            class="w-full py-4 text-xl font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Добавить в корзину
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(src) {
            document.getElementById('main-product-image').src = src;
        }
        function addToCart(productId) {
            console.log('Добавлен в корзину продукт ID:', productId);
        }
    </script>
@endsection