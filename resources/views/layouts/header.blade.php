<header class="main-header">
    <div class="bg-[#F5F5F5] text-sm py-2">
        <div
                class="container mx-auto px-4 flex justify-between items-center"
        >
            <p class="text-gray-700 font-bold">
                Жеткирүү кун сайын 09:00дөн 21:00гө чейин
            </p>
            <p class="text-gray-700 font-bold">+996 700 600 500</p>
        </div>
    </div>

    <nav class="bg-white w-full border-b">
        <div
                class="container mx-auto px-4 py-3 flex items-center justify-between"
        >
            <div class="flex items-center space-x-4">
                <a href="/"
                ><div class="h-10 w-24 bg-gray-300 rounded"></div
                    ></a>
            </div>

            <div class="flex items-center space-x-6">
                <div x-data="{ open: false }" class="relative">
                    <button
                            @click="open = !open"
                            class="flex items-center justify-between w-[338px] rounded-[12px] px-4 py-3 font-mont font-medium text-[16px] leading-[100%] text-[#646464] hover:bg-gray-50"
                    >
                        Категории
                    </button>

                    <template x-teleport="#svg-icons">
                        <svg
                                id="icon-arrow-right"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                        >
                            <path
                                    d="M16.0464 11.6464C16.2417 11.8417 16.2417 12.1583 16.0464 12.3536L10.7536 17.6464C10.5583 17.8417 10.2417 17.8417 10.0464 17.6464L9.35355 16.9536C9.15829 16.7583 9.15829 16.4417 9.35355 16.2464L13.2464 12.3536C13.4417 12.1583 13.4417 11.8417 13.2464 11.6464L9.35355 7.75355C9.15829 7.55829 9.15829 7.24171 9.35355 7.04645L10.0464 6.35355C10.2417 6.15829 10.5583 6.15829 10.7536 6.35355L16.0464 11.6464Z"
                                    fill="#646464"
                            />
                        </svg>
                    </template>

                    <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute left-0 mt-2 bg-white shadow-[0_0_4px_0_#EBEBEB] rounded-[16px] p-[12px] flex flex-col z-50"
                    >
                        <template x-for="cat in categories" :key="cat">
                            <a
                                    href="#"
                                    @click.prevent="selectCategory(cat); open = false"
                                    class="flex items-center justify-between w-[338px] rounded-[12px] px-4 py-3 font-[Montserrat] font-medium text-[16px] leading-[100%] text-[#646464]"
                            >
                                <span x-text="cat"></span>
                                <svg
                                        class="w-6 h-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                >
                                    <path
                                            d="M9 5l7 7-7 7"
                                            stroke="#646464"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                    />
                                </svg>
                            </a>
                        </template>
                    </div>
                </div>

                <div id="svg-icons" class="hidden"></div>

                <div class="relative w-[748px]">
                    <div
                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                    >
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                        >
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z"
                            />
                        </svg>
                    </div>

                    <input
                            x-model="searchQuery"
                            type="text"
                            placeholder="Китеп издөө"
                            class="w-full h-[52px] pl-12 pr-[100px] border-2 border-gray-300 rounded-[16px] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400"
                    />

                    <button
                            @click="performSearch"
                            class="absolute top-1/2 right-2 -translate-y-1/2 h-[40px] px-4 bg-[#FF9027] text-white font-medium rounded-[12px] flex items-center gap-2"
                    >

                        Издөө
                    </button>

                </div>
            </div>

            <div class="flex items-center space-x-4 text-sm font-medium">

                <a href="#" class="p-3 inline-flex items-center justify-center rounded-lg">

                <!-- heart icon -->
                    <svg
                            width="28"
                            height="28"
                            viewBox="0 0 28 28"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M14 23.4555L12.8065 22.3775C10.8998 20.6462 9.32294 19.1585 8.07597 17.9144C6.82919 16.6704 5.84112 15.5655 5.11176 14.5997C4.3822 13.6338 3.87325 12.7527 3.58489 11.9563C3.29652 11.1598 3.15234 10.3517 3.15234 9.53194C3.15234 7.92311 3.69484 6.5762 4.77984 5.49119C5.86504 4.406 7.21196 3.8634 8.82059 3.8634C9.82665 3.8634 10.7773 4.1016 11.6725 4.57799C12.5675 5.05438 13.3434 5.74543 14 6.65115C14.6782 5.74543 15.4588 5.05438 16.3418 4.57799C17.2246 4.1016 18.1705 3.8634 19.1794 3.8634C20.7881 3.8634 22.135 4.40581 23.2202 5.49061C24.3052 6.57522 24.8477 7.92156 24.8477 9.52961C24.8477 10.3507 24.7035 11.1595 24.4151 11.956C24.1268 12.7526 23.618 13.6337 22.8888 14.5991C22.1597 15.5645 21.1727 16.6696 19.9278 17.9144C18.6832 19.1595 17.1051 20.6472 15.1935 22.3775L14 23.4555Z"
                                fill="#FF2E17"
                        />
                    </svg>
                </a>

                <a href="#" class="relative bg-[#FFF4E9] p-3 inline-flex items-center justify-center rounded-lg">

                <!-- cart icon -->
                    <svg
                            width="22"
                            height="23"
                            viewBox="0 0 22 23"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M6.45575 22.1016C5.90858 22.1016 5.44308 21.9101 5.05925 21.527C4.67561 21.144 4.48379 20.6789 4.48379 20.1317C4.48379 19.5843 4.67532 19.1188 5.05837 18.7352C5.44143 18.3516 5.90654 18.1598 6.45371 18.1598C7.00087 18.1598 7.46638 18.3513 7.85021 18.7343C8.23385 19.1174 8.42567 19.5825 8.42567 20.1297C8.42567 20.6768 8.23414 21.1423 7.85108 21.5262C7.46803 21.9098 7.00292 22.1016 6.45575 22.1016ZM17.5513 22.1016C17.0042 22.1016 16.5387 21.9101 16.1548 21.527C15.7712 21.144 15.5794 20.6789 15.5794 20.1317C15.5794 19.5843 15.7709 19.1188 16.154 18.7352C16.537 18.3516 17.0021 18.1598 17.5493 18.1598C18.0967 18.1598 18.5622 18.3513 18.9458 18.7343C19.3294 19.1174 19.5212 19.5825 19.5212 20.1297C19.5212 20.6768 19.3297 21.1423 18.9467 21.5262C18.5636 21.9098 18.0985 22.1016 17.5513 22.1016ZM5.07937 3.91854L8.03658 10.1109H15.8722C15.9395 10.1109 15.9993 10.094 16.0516 10.0602C16.1041 10.0265 16.149 9.97986 16.1863 9.92017L19.3162 4.23267C19.3609 4.15042 19.3646 4.0775 19.3273 4.01392C19.29 3.95033 19.2264 3.91854 19.1365 3.91854H5.07937ZM4.29042 2.28637H20.1708C20.6443 2.28637 20.9993 2.48481 21.236 2.88167C21.4726 3.27872 21.4821 3.68229 21.2645 4.09238L17.621 10.6986C17.4453 11.0255 17.2012 11.2813 16.889 11.466C16.5767 11.6507 16.2411 11.7431 15.8821 11.7431H7.51158L6.13725 14.2581C6.07736 14.3478 6.07551 14.445 6.13171 14.5498C6.18771 14.6544 6.27181 14.7067 6.384 14.7067H19.5212V16.3389H6.45896C5.69926 16.3389 5.12886 16.0174 4.74775 15.3743C4.36683 14.7313 4.35322 14.087 4.70692 13.4415L6.37175 10.4773L2.17671 1.63217H0V0H3.2025L4.29042 2.28637Z"
                                fill="#FF9027"
                        />
                    </svg>
                    <!-- badge -->
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold w-5 h-5 flex items-center justify-center rounded-full">
        3
    </span>
                </a>

                <div class="relative">
                    @auth
                        <!-- Пользователь авторизован -->
                        <div x-data="{ open: false }" class="relative">
                            <button
                                    @click="open = !open"
                                    class="px-6 py-3 bg-[#FF9027] text-white font-mont font-semibold text-[18px] leading-[120%] rounded-[14px] hover:bg-orange-600 transition-colors inline-flex items-center justify-center"
                            >
                                {{ auth()->user()->name }}
                            </button>

                            <!-- Попап -->
                            <div
                                    x-show="open"
                                    @click.outside="open = false"
                                    x-transition
                                    class="absolute left-[-20px] mt-2 bg-white shadow-[0_0_4px_0_#EBEBEB] rounded-[16px] p-4 flex flex-col z-50 w-[300px]"
                            >
                                <div class="flex flex-col mb-4">
                                    <span class="font-semibold text-[16px]">{{ auth()->user()->name }}</span>
                                    <span class="text-sm text-gray-500">{{ auth()->user()->email }}</span>
                                </div>
                                <a
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="flex items-center gap-2 px-4 py-3 rounded-[12px] text-[#FF2E17] hover:bg-gray-100 transition-colors font-medium"
                                >
                                    <!-- иконка выхода -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                    </svg>
                                    Выйти
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Гость -->
                        <a href="{{ route('login') }}"
                           class="px-6 py-3 bg-[#FF9027] text-white font-mont  text-[18px] leading-[120%] rounded-[14px] hover:bg-orange-600 transition-colors inline-flex items-center justify-center">
                            Кирүү
                        </a>
                    @endauth
                </div>


            </div>
        </div>
    </nav>
</header>

