<header class="main-header" x-data="{ categoriesOpen: false }">

    <!-- Desktop Top Bar -->
    <div class="hidden lg:block bg-[#F5F5F5] text-sm py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p class="text-gray-700 font-bold">
                Жеткирүү кун сайын 09:00дөн 21:00гө чейин
            </p>
            <a href="tel:+996700600500" class="text-gray-700 font-bold">
                +996 700 600 500
            </a>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:block bg-white w-full border-b">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ config('app.logo') }}" alt="Logo" class="h-16 object-contain">
                </a>
            </div>

            <!-- Categories + Search -->
            <div class="flex items-center space-x-6">

                <!-- Categories Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="flex items-center justify-between w-[338px] rounded-[12px] px-4 py-3 font-medium text-[16px] text-[#646464] hover:bg-gray-50">
                        Категории
                        <svg class="w-6 h-6 transform transition-transform" :class="{'rotate-90': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path d="M16.0464 11.6464C16.2417 11.8417 16.2417 12.1583 16.0464 12.3536L10.7536 17.6464C10.5583 17.8417 10.2417 17.8417 10.0464 17.6464L9.35355 16.9536C9.15829 16.7583 9.15829 16.4417 9.35355 16.2464L13.2464 12.3536C13.4417 12.1583 13.4417 11.8417 13.2464 11.6464L9.35355 7.75355C9.15829 7.55829 9.15829 7.24171 9.35355 7.04645L10.0464 6.35355C10.2417 6.15829 10.5583 6.15829 10.7536 6.35355L16.0464 11.6464Z" fill="#646464"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute left-0 mt-2 bg-white shadow-[0_0_4px_0_#EBEBEB] rounded-[16px] p-[12px] flex flex-col z-50 w-[338px]">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $category)
                                <a href="{{ route('products.category', ['category' => $category['slug']]) }}"
                                 @click="open = false"
                                   class="flex items-center justify-between w-full rounded-[12px] px-4 py-3 text-[16px] text-[#646464] hover:bg-gray-100 transition-colors">
                                    <span>{{ $category->name }}</span>
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 5l7 7-7 7" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @endforeach

                        @else
                            <span class="px-4 py-3 text-gray-500">Нет доступных категорий.</span>
                        @endif
                    </div>
                </div>

                <div class="relative w-[748px]" x-data="{ searchQuery: '' }">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z"/>
                        </svg>
                    </div>
                    <input x-model="searchQuery" type="text" placeholder="Китеп издөө"
                           class="w-full h-[52px] pl-12 pr-[100px] border-2 border-gray-300 rounded-[16px] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400"/>
                    <button @click="window.location.href='/search?q=' + encodeURIComponent(searchQuery)"
                            class="absolute top-1/2 right-2 -translate-y-1/2 h-[40px] px-4 bg-[#FF9027] text-white font-medium rounded-[12px] flex items-center gap-2">
                        Издөө
                    </button>
                </div>
            </div>

            <div class="flex items-center space-x-4 text-sm font-medium">

                <a href="{{route('wishlist.index')}}" class="p-3 inline-flex items-center justify-center rounded-lg">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.8477 19.5921L9.65417 18.5141C7.74744 16.7828 6.1706 15.2951 4.92362 14.051C3.67685 12.807 2.68878 11.7021 1.95942 10.7362C1.22986 9.77044 0.720903 8.88932 0.432542 8.09287C0.144181 7.29643 0 6.48832 0 5.66854C0 4.05971 0.5425 2.71279 1.6275 1.62779C2.71269 0.542597 4.05961 0 5.66825 0C6.67431 0 7.62494 0.238194 8.52017 0.714583C9.41519 1.19097 10.191 1.88203 10.8477 2.78775C11.5259 1.88203 12.3065 1.19097 13.1895 0.714583C14.0722 0.238194 15.0181 0 16.0271 0C17.6357 0 18.9826 0.542402 20.0678 1.62721C21.1528 2.71182 21.6953 4.05815 21.6953 5.66621C21.6953 6.48735 21.5512 7.29614 21.2628 8.09258C20.9744 8.88922 20.4657 9.77025 19.7365 10.7357C19.0073 11.7011 18.0203 12.8062 16.7755 14.051C15.5309 15.2961 13.9527 16.7838 12.0412 18.5141L10.8477 19.5921Z" fill="#FF2E17"/>
                    </svg>
                </a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative bg-[#FFF4E9] p-3 rounded-lg inline-flex items-center justify-center">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.45575 22.1016C5.90858 22.1016 5.44308 21.9101 5.05925 21.527C4.67561 21.144 4.48379 20.6789 4.48379 20.1317C4.48379 19.5843 4.67532 19.1188 5.05837 18.7352C5.44143 18.3516 5.90654 18.1598 6.45371 18.1598C7.00087 18.1598 7.46638 18.3513 7.85021 18.7343C8.23385 19.1174 8.42567 19.5825 8.42567 20.1297C8.42567 20.6768 8.23414 21.1423 7.85108 21.5262C7.46803 21.9098 7.00292 22.1016 6.45575 22.1016ZM17.5513 22.1016C17.0042 22.1016 16.5387 21.9101 16.1548 21.527C15.7712 21.144 15.5794 20.6789 15.5794 20.1317C15.5794 19.5843 15.7709 19.1188 16.154 18.7352C16.537 18.3516 17.0021 18.1598 17.5493 18.1598C18.0967 18.1598 18.5622 18.3513 18.9458 18.7343C19.3294 19.1174 19.5212 19.5825 19.5212 20.1297C19.5212 20.6768 19.3297 21.1423 18.9467 21.5262C18.5636 21.9098 18.0985 22.1016 17.5513 22.1016ZM5.07937 3.91854L8.03658 10.1109H15.8722C15.9395 10.1109 15.9993 10.094 16.0516 10.0602C16.1041 10.0265 16.149 9.97986 16.1863 9.92017L19.3162 4.23267C19.3609 4.15042 19.3646 4.0775 19.3273 4.01392C19.29 3.95033 19.2264 3.91854 19.1365 3.91854H5.07937ZM4.29042 2.28637H20.1708C20.6443 2.28637 20.9993 2.48481 21.236 2.88167C21.4726 3.27872 21.4821 3.68229 21.2645 4.09238L17.621 10.6986C17.4453 11.0255 17.2012 11.2813 16.889 11.466C16.5767 11.6507 16.2411 11.7431 15.8821 11.7431H7.51158L6.13725 14.2581C6.07736 14.3478 6.07551 14.445 6.13171 14.5498C6.18771 14.6544 6.27181 14.7067 6.384 14.7067H19.5212V16.3389H6.45896C5.69926 16.3389 5.12886 16.0174 4.74775 15.3743C4.36683 14.7313 4.35322 14.087 4.70692 13.4415L6.37175 10.4773L2.17671 1.63217H0V0H3.2025L4.29042 2.28637Z" fill="#FF9027"/>
                        </svg>

                        <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold w-5 h-5 flex items-center justify-center rounded-full"></span>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-0 top-12 mt-2 w-96 bg-white shadow-lg rounded-xl p-4 z-50">
                        <h3 class="font-semibold text-lg mb-4">Корзина</h3>

                        <template x-if="$store.cart.items.length > 0">
                            <div class="flex flex-col gap-3 max-h-80 overflow-auto">
                                <template x-for="item in $store.cart.items" :key="item.id">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <img :src="item.img" class="w-14 h-14 object-cover rounded-lg">
                                            <div>
                                                <p class="font-medium" x-text="item.name"></p>
                                                <p class="text-sm text-gray-500">Цена: <span x-text="formatPrice(item.price)"></span></p>
                                                <p class="text-sm text-gray-500">Кол-во: <span x-text="item.quantity"></span></p>
                                            </div>
                                        </div>
                                        <button @click="$store.cart.remove(item.id)"
                                                class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="$store.cart.items.length === 0">
                            <p class="text-gray-500 text-center py-10">Корзина пуста</p>
                        </template>

                        <div class="mt-4 border-t pt-3 flex justify-between items-center">
                            <span class="font-semibold">Итого:</span>
                            <span class="font-bold text-lg"
                                  x-text="formatPrice($store.cart.items.reduce((total, i) => total + i.price * i.quantity, 0))"></span>
                        </div>

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart" :value="JSON.stringify($store.cart.items)" />
                            <button type="submit"
                                    class="w-full mt-3 bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                                Оформить заказ
                            </button>
                        </form>
                    </div>
                </div>

                <div>
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="px-6 py-3 bg-[#FF9027] text-white rounded-[14px] font-semibold">
                                {{ auth()->user()->name }}
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition
                                 class="absolute left-0 mt-2 bg-white shadow-[0_0_4px_0_#EBEBEB] rounded-[16px] p-4 flex flex-col z-50 w-[300px]">
                                <div class="flex flex-col mb-4">
                                    <span class="font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="text-sm text-gray-500">{{ auth()->user()->email }}</span>
                                </div>
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-4 py-3 rounded-[12px] hover:bg-gray-100">Мои заказы</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2 px-4 py-3 rounded-[12px] text-red-500 hover:bg-gray-100">Выйти</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-[#FF9027] text-white rounded-[14px] font-semibold">Кирүү</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="lg:hidden bg-white text-sm py-3 border-b">
        <div class="container mx-auto px-4 flex justify-between items-center text-gray-700">
            <p class="font-bold text-sm">
                Жеткирүү кун сайын <br> 09:00дөн 21:00гө чейин
            </p>
            <a href="tel:+996700600500" class="font-bold text-lg">+996 700 600 500</a>
        </div>
    </div>

    <nav class="lg:hidden bg-white w-full">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">

            <div class="flex items-center">
                <a href="/">
                    <img src="{{ config('app.logo') }}" alt="Logo" class="h-10 object-contain">
                </a>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{route('wishlist.index')}}" class="p-3 inline-flex items-center justify-center rounded-lg">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.8477 19.5921L9.65417 18.5141C7.74744 16.7828 6.1706 15.2951 4.92362 14.051C3.67685 12.807 2.68878 11.7021 1.95942 10.7362C1.22986 9.77044 0.720903 8.88932 0.432542 8.09287C0.144181 7.29643 0 6.48832 0 5.66854C0 4.05971 0.5425 2.71279 1.6275 1.62779C2.71269 0.542597 4.05961 0 5.66825 0C6.67431 0 7.62494 0.238194 8.52017 0.714583C9.41519 1.19097 10.191 1.88203 10.8477 2.78775C11.5259 1.88203 12.3065 1.19097 13.1895 0.714583C14.0722 0.238194 15.0181 0 16.0271 0C17.6357 0 18.9826 0.542402 20.0678 1.62721C21.1528 2.71182 21.6953 4.05815 21.6953 5.66621C21.6953 6.48735 21.5512 7.29614 21.2628 8.09258C20.9744 8.88922 20.4657 9.77025 19.7365 10.7357C19.0073 11.7011 18.0203 12.8062 16.7755 14.051C15.5309 15.2961 13.9527 16.7838 12.0412 18.5141L10.8477 19.5921Z" fill="#FF2E17"/>
                    </svg>
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative bg-[#FFF4E9] p-3 rounded-[14px] inline-flex items-center justify-center">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.45575 22.1016C5.90858 22.1016 5.44308 21.9101 5.05925 21.527C4.67561 21.144 4.48379 20.6789 4.48379 20.1317C4.48379 19.5843 4.67532 19.1188 5.05837 18.7352C5.44143 18.3516 5.90654 18.1598 6.45371 18.1598C7.00087 18.1598 7.46638 18.3513 7.85021 18.7343C8.23385 19.1174 8.42567 19.5825 8.42567 20.1297C8.42567 20.6768 8.23414 21.1423 7.85108 21.5262C7.46803 21.9098 7.00292 22.1016 6.45575 22.1016ZM17.5513 22.1016C17.0042 22.1016 16.5387 21.9101 16.1548 21.527C15.7712 21.144 15.5794 20.6789 15.5794 20.1317C15.5794 19.5843 15.7709 19.1188 16.154 18.7352C16.537 18.3516 17.0021 18.1598 17.5493 18.1598C18.0967 18.1598 18.5622 18.3513 18.9458 18.7343C19.3294 19.1174 19.5212 19.5825 19.5212 20.1297C19.5212 20.6768 19.3297 21.1423 18.9467 21.5262C18.5636 21.9098 18.0985 22.1016 17.5513 22.1016ZM5.07937 3.91854L8.03658 10.1109H15.8722C15.9395 10.1109 15.9993 10.094 16.0516 10.0602C16.1041 10.0265 16.149 9.97986 16.1863 9.92017L19.3162 4.23267C19.3609 4.15042 19.3646 4.0775 19.3273 4.01392C19.29 3.95033 19.2264 3.91854 19.1365 3.91854H5.07937ZM4.29042 2.28637H20.1708C20.6443 2.28637 20.9993 2.48481 21.236 2.88167C21.4726 3.27872 21.4821 3.68229 21.2645 4.09238L17.621 10.6986C17.4453 11.0255 17.2012 11.2813 16.889 11.466C16.5767 11.6507 16.2411 11.7431 15.8821 11.7431H7.51158L6.13725 14.2581C6.07736 14.3478 6.07551 14.445 6.13171 14.5498C6.18771 14.6544 6.27181 14.7067 6.384 14.7067H19.5212V16.3389H6.45896C5.69926 16.3389 5.12886 16.0174 4.74775 15.3743C4.36683 14.7313 4.35322 14.087 4.70692 13.4415L6.37175 10.4773L2.17671 1.63217H0V0H3.2025L4.29042 2.28637Z" fill="#FF9027"/>
                        </svg>
                        <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold w-5 h-5 flex items-center justify-center"></span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-2 top-10 mt-2 w-80 bg-white shadow-lg rounded-xl p-4 z-50">
                        <h3 class="font-semibold text-lg mb-4">Корзина</h3>
                        <template x-if="$store.cart.items.length > 0">
                            <div class="flex flex-col gap-3 max-h-80 overflow-auto">
                                <template x-for="item in $store.cart.items" :key="item.id">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <img :src="item.img" class="w-14 h-14 object-cover rounded-lg">
                                            <div>
                                                <p class="font-medium" x-text="item.name"></p>
                                                <p class="text-sm text-gray-500">Цена: <span x-text="formatPrice(item.price)"></span></p>
                                                <p class="text-sm text-gray-500">Кол-во: <span x-text="item.quantity"></span></p>
                                            </div>
                                        </div>
                                        <button @click="$store.cart.remove(item.id)" class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="$store.cart.items.length === 0">
                            <p class="text-gray-500 text-center py-10">Корзина пуста</p>
                        </template>
                        <div class="mt-4 border-t pt-3 flex justify-between items-center">
                            <span class="font-semibold">Итого:</span>
                            <span class="font-bold text-lg"
                                  x-text="formatPrice($store.cart.items.reduce((total, i) => total + i.price * i.quantity, 0))"></span>
                        </div>
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart" :value="JSON.stringify($store.cart.items)" />
                            <button type="submit"
                                    class="w-full mt-3 bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                                Оформить заказ
                            </button>
                        </form>
                    </div>
                </div>
                <button @click="categoriesOpen = true" class="p-3 bg-[#FF9027] rounded-[14px]">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    <div class="lg:hidden container mx-auto px-4 py-3" x-data="{ searchQuery: '' }">
        <div class="relative flex">
            <input x-model="searchQuery" type="text" placeholder="Китеп издөө"
                   class="w-full h-[52px] pl-4 pr-3 border-2 border-gray-300 rounded-l-[16px] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400"/>
            <button @click="window.location.href='/search?q=' + encodeURIComponent(searchQuery)"
                    class="h-[52px] px-6 bg-[#FF9027] text-white font-medium rounded-r-[16px] flex items-center justify-center hover:bg-orange-600 transition">
                Издөө
            </button>
        </div>
    </div>
    <div x-show="categoriesOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed inset-0 bg-white z-[9999] overflow-y-auto">
        <div class="p-4 flex justify-between items-center border-b">
            <a href="/"><img src="{{ config('app.logo') }}" alt="Logo" class="h-10 object-contain"></a>
            <button @click="categoriesOpen = false" class="p-2">
                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <h2 class="text-2xl font-bold mb-6">Категориялар</h2>
            <div class="flex flex-col space-y-2 mb-6">
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', $category) }}" @click="categoriesOpen = false"
                           class="flex items-center justify-between px-4 py-3 rounded-[12px] bg-gray-100 hover:bg-gray-200">
                            <span>{{ $category->name }}</span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                <path d="M9 5l7 7-7 7" stroke="#646464" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</header>
