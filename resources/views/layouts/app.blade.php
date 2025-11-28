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
<body class="antialiased"  x-data="catalog()">

<div>
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
</div>

<script>
    const swiper = new Swiper('.mySwiper', {
        loop: true,
        pagination: { el: '.swiper-pagination' },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            items: JSON.parse(localStorage.getItem('cartItems')) || [],

            get count() {
                return this.items.reduce((total, item) => total + item.quantity, 0);
            },

            add(product) {
                const existing = this.items.find(i => i.id === product.id);
                existing
                    ? existing.quantity < product.quantity
                        ? existing.quantity++
                        : alert('Достигнут лимит доступного количества')
                    : product.quantity > 0
                        ? this.items.push({ ...product, quantity: 1 })
                        : alert('Товар отсутствует на складе');

                this.save();
            },

            remove(productId) {
                this.items = this.items.filter(i => i.id !== productId);
                this.save();
            },

            clear() {
                this.items = [];
                this.save();
            },

            save() {
                localStorage.setItem('cartItems', JSON.stringify(this.items));
            },
        });
    });

    function formatPrice(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' с';
    }
</script>
<script>
    document.addEventListener('alpine:init', () => {
        const csrfToken = document.querySelector('meta[name=csrf-token]').content;

        Alpine.store('wishlist', {
            items: @json($wishlistProductIds ?? []),

            isIn(id) {
                return this.items.includes(id);
            },

            async add(product) {
                try {
                    const resp = await fetch(`/wishlist`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({ product_id: product.id })
                    });

                    if (!resp.ok) throw new Error('Ошибка добавления в избранное');

                    this.items.push(product.id);
                } catch (e) {
                    console.error(e);
                }
            },

            async remove(product) {
                try {
                    const resp = await fetch(`/wishlist/${product.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    });

                    if (!resp.ok) throw new Error('Ошибка удаления из избранного');

                    this.items = this.items.filter(i => i !== product.id);
                } catch (e) {
                    console.error(e);
                }
            },

            async toggle(product) {
                if (this.isIn(product.id)) {
                    await this.remove(product);
                } else {
                    await this.add(product);
                }
            }
        });
    });
</script>
</body>
</html>
