<div x-data="catalog()" class="container mx-auto mt-[24px] p-4">
        <div class="mb-6 lg:hidden">
            <div class="flex overflow-x-auto space-x-2 pb-2 -mx-4 px-4 whitespace-nowrap scrollbar-hide">
                <template x-for="cat in categories" :key="cat">
                    <button @click.prevent="selectCategory(cat)"
                            :class="{
                                'bg-orange-500 text-white shadow-md': activeCategory === cat,
                                ' text-gray-800 hover:bg-gray-200': activeCategory !== cat
                            }"
                            class="flex-shrink-0 rounded-lg px-5 py-2.5 font-medium text-sm transition duration-150 ease-in-out">
                        <span x-text="cat.replace('Бардык товарлар', 'Бардыгы')"></span>
                    </button>
                </template>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-3 hidden md:block">
                <div class="sticky top-20 h-[calc(100vh-5rem)] overflow-auto">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Категориялар</h2>
                    <div class="bg-white rounded-2xl p-3 flex flex-col shadow-lg">
                        <template x-for="cat in categories" :key="cat">
                            <a href="#" @click.prevent="selectCategory(cat)"
                               :class="{
                                   'bg-gray-100 text-[#646464]': activeCategory === cat,
                                   'text-gray-600 hover:bg-gray-50': activeCategory !== cat
                               }"
                               class="flex items-center justify-between w-full rounded-xl px-4 py-3 font-medium text-base">
                                <span x-text="cat"></span>
                                <svg class="w-6 h-6"
                                     :class="{'text-[#646464]': activeCategory === cat, 'text-gray-600': activeCategory !== cat}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="col-span-12 md:col-span-9">
                <div class="flex items-baseline justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800" x-text="activeCategory"></h2>
                    <p class="text-sm text-gray-500">
                        Табылды: <span x-text="filteredProducts.length"></span>
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <a :href="`/products/${product.slug}`" class="block">
                            <div x-show="true" x-transition.opacity.duration.300ms
                                 class="bg-white rounded-[14px] overflow-hidden flex flex-col p-2 md:p-3 relative shadow-xl hover:shadow-2xl transition max-w-sm border border-gray-100">
                                <button
                                        @click.stop.prevent="$store.wishlist.toggle(product)"
                                        :class="$store.wishlist.isIn(product.id) ? 'text-[#FF2E17] fill-[#FF2E17] bg-[#FFF4E9]' : 'text-[#FF9027] bg-[#FFF4E9]'"
                                        class="absolute bg-[#FFF4E9] top-2 right-2 md:top-4 md:right-4 rounded-[12px] p-1 md:p-2 transition z-10"
                                        title="Сүйүктүүлөргө сактоо"
                                >
                                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.7373 1C14.8652 1 15.7614 1.36915 16.4941 2.10156C17.2266 2.83379 17.5956 3.7293 17.5957 4.85645C17.5957 5.3676 17.5179 5.8746 17.3584 6.37988L17.2852 6.5957C17.0832 7.15371 16.7074 7.82081 16.1191 8.59961C15.6783 9.18325 15.1109 9.84138 14.4131 10.5762L13.6719 11.3369C12.621 12.3881 11.2813 13.6506 9.65039 15.127L9.29785 15.4453L8.94531 15.127C7.31882 13.65 5.98026 12.387 4.92676 11.3359C4.00859 10.4198 3.27154 9.60754 2.70801 8.89746L2.47754 8.59961L2.2666 8.3125C1.79773 7.65548 1.48725 7.08467 1.31055 6.59668C1.10157 6.01948 1 5.44113 1 4.8584C1.00008 3.73046 1.37004 2.83504 2.10254 2.10254C2.8353 1.36984 3.73067 1.00002 4.8584 1C5.55545 1 6.20917 1.16319 6.83301 1.49512C7.45251 1.82486 8.00538 2.31049 8.48828 2.97656L9.28516 4.0752L10.0986 2.98926C10.6042 2.31411 11.1665 1.82336 11.7803 1.49219C12.39 1.16319 13.0374 1.00003 13.7373 1Z" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>


                                <div class="h-40 md:h-64 w-full rounded-[10px] md:rounded-[16px] mb-2 overflow-hidden flex justify-center items-center p-2">
                                    <img :src="product.img"
                                         class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out"
                                         alt="Product image"/>
                                </div>

                                <div class="flex flex-col text-gray-900 px-1">
                                    <p class="text-base md:text-xl font-semibold whitespace-nowrap overflow-hidden text-ellipsis mb-1"
                                       x-text="product.name"></p>
                                    <div class="text-xs md:text-sm font-medium mb-2"
                                         :class="product.quantity > 0 ? 'text-green-600' : 'text-red-600'"
                                         x-text="product.quantity > 0 ? 'Кампада' : 'Кампада жок'">
                                    </div>

                                    <div class="flex items-end justify-between mt-2">
                                        <div class="flex flex-col">
                                            <p class="text-2xl text-[#FF9027] md:text-3xl font-extrabold"
                                               x-text="formatPrice(product.price)"></p>
                                            <p x-show="product.old_price && product.old_price > product.price"
                                               class="text-xs md:text-sm text-gray-400 line-through mt-0.5"
                                               x-text="formatPrice(product.old_price)"></p>
                                        </div>

                                        <button @click.stop.prevent="addToCart(product)"
                                                class="bg-gray-200 text-gray-800 p-3 md:p-4 rounded-lg md:rounded-xl hover:bg-gray-300 transition">
                                            <svg class="w-5 h-5 md:w-6 md:h-6" viewBox="0 0 27 26" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 9.859L12.6077 8.46667L15.054 6H9V4H15.054L12.5873 1.53333L14 0.140999L18.859 5L14 9.859ZM7.53833 25.7437C6.89056 25.7437 6.33978 25.5167 5.886 25.0627C5.43222 24.6089 5.20533 24.0581 5.20533 23.4103C5.20533 22.7623 5.43222 22.2114 5.886 21.7577C6.33978 21.3039 6.89056 21.077 7.53833 21.077C8.18633 21.077 8.73722 21.3039 9.191 21.7577C9.64478 22.2114 9.87167 22.7623 9.87167 23.4103C9.87167 24.0581 9.64478 24.6089 9.191 25.0627C8.73722 25.5167 8.18633 25.7437 7.53833 25.7437ZM20.4617 25.7437C19.8137 25.7437 19.2628 25.5167 18.809 25.0627C18.3552 24.6089 18.1283 24.0581 18.1283 23.4103C18.1283 22.7623 18.3552 22.2114 18.809 21.7577C19.2628 21.3039 19.8137 21.077 20.4617 21.077C21.1094 21.077 21.6602 21.3039 22.114 21.7577C22.5678 22.2114 22.7947 22.7623 22.7947 23.4103C22.7947 24.0581 22.5678 24.6089 22.114 25.0627C21.6602 25.5167 21.1094 25.7437 20.4617 25.7437ZM0 2V0H3.81533L9.37933 11.7437H18.4693C18.5462 11.7437 18.6146 11.7244 18.6743 11.686C18.7341 11.6476 18.7854 11.5941 18.8283 11.5257L23.759 2.66667H26.0357L20.5793 12.523C20.3607 12.9077 20.0714 13.2072 19.7117 13.4217C19.3517 13.6363 18.9572 13.7437 18.5283 13.7437H8.8L7.25633 16.564C7.18789 16.6667 7.18578 16.7778 7.25 16.8973C7.314 17.0171 7.41011 17.077 7.53833 17.077H22.7947V19.077H7.53833C6.64944 19.077 5.97811 18.697 5.52433 17.937C5.07056 17.1772 5.05822 16.4084 5.48733 15.6307L7.38967 12.2103L2.53867 2H0Z"
                                                      fill="black"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>

                    <div x-show="filteredProducts.length === 0" class="col-span-full text-center text-gray-500 py-10">
                        Бул категорияда товарлар табылган жок.
                    </div>

                </div>

            </div>
        </div>

        <script>
            function catalog() {
                const categoriesData = @json($categories);

                const allCategories = categoriesData;

                return {
                    categories: allCategories,
                    products: @json($products),
                    activeCategory: categoriesData[0] || 'Категориялар',

                    get filteredProducts() {
                        if (!this.products || this.products.length === 0) return [];

                        return this.products.filter(p => p.category === this.activeCategory);
                    },

                    selectCategory(cat) {
                        this.activeCategory = cat;
                    },

                    addToCart(product) {
                        Alpine.store('cart').add(product);
                    },

                    formatPrice(value) {
                        if (!value && value !== 0) return '';
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + 'с';
                    },
                };
            }
        </script>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

