<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="antialiased" x-data="catalog()" x-cloak>

<div>
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
</div>
@stack('page-scripts')

<script>

    const swiper = new Swiper('.mySwiper', {
        loop: true,
        pagination: { el: '.swiper-pagination' },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    function catalog() {
        return {
            categories: ['Категория 1', 'Категория 2', 'Категория 3'],
            activeCategory: 'Категория 1',
            cardsLoading: false,
            searchQuery: '',

            products: [
                {
                    id: 1,
                    name: 'Товар A',
                    category: 'Категория 1',
                    price: 12990,
                    old_price: 15990,
                    img: 'https://placehold.co/600x400?text=Товар+A',
                },
                {
                    id: 2,
                    name: 'Товар B',
                    category: 'Категория 2',
                    price: 9900,
                    old_price: 11900,
                    img: 'https://placehold.co/600x400?text=Товар+B',
                },
                {
                    id: 3,
                    name: 'Товар C',
                    category: 'Категория 3',
                    price: 14990,
                    old_price: 17990,
                    img: 'https://placehold.co/600x400?text=Товар+C',
                },
                {
                    id: 4,
                    name: 'Товар D',
                    category: 'Категория 1',
                    price: 10990,
                    old_price: 13990,
                    img: 'https://placehold.co/600x400?text=Товар+D',
                },
                {
                    id: 5,
                    name: 'Товар E',
                    category: 'Категория 2',
                    price: 11990,
                    old_price: 13990,
                    img: 'https://placehold.co/600x400?text=Товар+E',
                },
            ],

            get filteredProducts() {
                const byCategory = this.products.filter(
                    (p) => p.category === this.activeCategory
                );

                if (!this.searchQuery) return byCategory;
                const q = this.searchQuery.toLowerCase();

                return byCategory.filter((p) =>
                    p.name.toLowerCase().includes(q)
                );
            },

            selectCategory(cat) {
                if (this.activeCategory === cat) return;

                this.activeCategory = cat;
                this.cardsLoading = true;

                setTimeout(() => {
                    this.cardsLoading = false;
                }, 400);
            },

            performSearch() {
                this.cardsLoading = true;
                setTimeout(() => {
                    this.cardsLoading = false;
                }, 300);
            },

            addToCart(product) {
                alert(product.name + ' добавлен в корзину');
            },

            formatPrice(value) {
                if (!value && value !== 0) return '';
                return (
                    value
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + 'с'
                );
            },
        };
    }

</script>
</body>
</html>
