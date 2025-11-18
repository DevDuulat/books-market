<div class="container mx-auto px-4 mt-10">
    <div class="swiper mySwiper relative h-[300px] sm:h-[350px] md:h-[400px] rounded-[30px] shadow-lg z-0">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide">
                    <a href="{{ $banner->link }}" target="_blank">
                        <img
                                src="{{ asset('storage/' . $banner->image_path) }}"
                                alt="Banner {{ $banner->id }}"
                                class="w-full h-full object-cover rounded-[30px]"
                        />
                    </a>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
    </div>
</div>