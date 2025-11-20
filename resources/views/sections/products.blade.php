<div x-data="catalog()" class="container mx-auto mt-[80px] p-4">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-3">
            <div class="sticky top-20 h-[calc(100vh-5rem)] overflow-auto">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Категории</h2>
                <div class="bg-white rounded-2xl p-3 flex flex-col ы card">
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
                    Найдено: <span x-text="filteredProducts.length"></span>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="product in filteredProducts" :key="product.id">
                    <a :href="`/products/${product.slug}`" class="block">
                        <div x-show="true" x-transition.opacity.duration.300ms
                             class="bg-white rounded-[24px] overflow-hidden flex flex-col p-3 relative shadow-xl hover:shadow-2xl transition max-w-sm border border-gray-100">

                            <button @click.stop.prevent="$store.wishlist.toggle(product)"
                                    :class="$store.wishlist.isIn(product.id) ? 'text-red-500' : 'text-gray-500'"
                                    class="absolute top-4 right-4 bg-gray-100 rounded-full p-2 transition z-10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>



                            <div class="h-64 w-full rounded-[16px] mb-4 overflow-hidden flex justify-center items-center bg-gray-50 p-4">
                                <img :src="product.img"
                                     class="max-h-full w-auto object-contain transition-transform duration-300 ease-in-out"
                                     alt="Product image"/>
                            </div>

                            <div class="flex flex-col text-gray-900 px-1">
                                <p class="text-xl font-semibold whitespace-nowrap overflow-hidden text-ellipsis mb-1" x-text="product.name"></p>
                                <div class="text-sm font-medium mb-4"
                                     :class="product.quantity > 0 ? 'text-green-600' : 'text-red-600'"
                                     x-text="product.quantity > 0 ? 'В наличии' : 'Нет в наличии'">
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <p class="text-gray-900 text-4xl font-extrabold" x-text="formatPrice(product.price)"></p>
                                        <p x-show="product.old_price" class="text-gray-400 text-sm line-through mt-0.5" x-text="formatPrice(product.old_price)"></p>
                                    </div>

                                    <button @click.stop.prevent="addToCart(product)"
                                            class="bg-gray-200 text-gray-800 p-4 rounded-xl hover:bg-gray-300 transition">
                                        В корзину
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </template>


                <div x-show="filteredProducts.length === 0" class="col-span-full text-center text-gray-500 py-10">
                    Товары не найдены в этой категории.
                </div>
            </div>
        </div>
    </div>

    <script>
        function catalog() {
            const categoriesData = @json($categories);
            const allCategories = ['Все товары', ...categoriesData];
            const productsData = @json($products);


            return {
                categories: allCategories,
                activeCategory: 'Все товары',
                products: productsData,


                get cartCount() {
                    return Alpine.store('cart').count;
                },

                get filteredProducts() {
                    if (this.activeCategory === 'Все товары') return this.products;
                    return this.products.filter(p => p.category === this.activeCategory);
                },

                selectCategory(cat) {
                    this.activeCategory = cat;
                },

                addToCart(product) {
                    Alpine.store('cart').add(product);
                },

                cartTotal() {
                    return Alpine.store('cart').items.reduce((total, item) => total + item.price * item.quantity, 0);
                },

                formatPrice(value) {
                    if (!value && value !== 0) return '';
                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + 'с';
                },



            };
        }
    </script>

</div>
