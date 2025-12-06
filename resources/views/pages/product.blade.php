@extends('layouts.app')

@section('content')
    <div id="TopNavAbsolute"
        class="absolute top-0 left-0 right-0 flex items-center justify-between w-full px-5 py-3 z-10 bg-gradient-to-b from-black/80 to-transparent">
        <a href="{{ route('index', $store->username) }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10">
            <img src="{{ asset('assets/images/icons/Arrow - Left.svg') }}" class="w-8 h-8" alt="icon">
        </a>
        <p class="font-semibold text-white">Details</p>
        <button class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10">
            <img src="{{ asset('assets/images/icons/Thumbs Up.svg') }}" class="w-[26px] h-[26px]" alt="">
        </button>
    </div>

    <div id="Image" class="relative w-full overflow-x-hidden -mb-[38px]">
        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-[500px] object-cover">

        <div class="absolute bottom-20 right-5 flex items-center gap-1  bg-white/10 px-[8px] py-[4px] rounded-full">
            <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating" class="w-4 h-4">
            <p class="text-white text-sm">{{ $product->rating }}</p>
        </div>
    </div>

    <!-- details -->
    <div class="flex flex-col w-full px-5 py-5 gap-5 bg-white rounded-t-[20px] shadow-sm mt-[-20px] z-10">
        <div id="Title">
            <p class="text-[#F3AF00] font-[400] text-[12px]">
                {{ $product->productCategory->name }}
            </p>
            <h1 class="text-[26px] font-semibold">{{ $product->name }}</h1>
            <p class="text-[#606060] font-[400] text-[14px]">
                {{ $product->description }}
            </p>
        </div>
        <div id="Ingredients">
            <h2 class="font-[500] mb-3">Ingredients used</h2>
            <div class="grid grid-cols-2 gap-3">
                @foreach ($product->productIngredients as $ingredient)
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/ic_check.svg') }}" alt="icon" class="w-5 h-5">
                        <span class="text-sm text-gray-600">{{ $ingredient->name }}</span>
                    </div>
                @endforeach

            </div>
        </div>
        <div id="Reviews">
            <h2 class="font-[500] mb-3">Customer Reviews</h2>

            <div class="swiper w-full">
                <div class="swiper-wrapper">
                    <div class="swiper-slide !w-fit">
                        <div
                            class="flex flex-col gap-3 w-[320px] border border-gray-200 hover:border-[#F3AF00] hover:bg-[#FFF7F0] hover:cursor-pointer rounded-[8px] p-4">
                            <div class="flex items-center justify-between gap-3">
                                <h3 class="text-[#353535] font-[500] text-[14px]">Muhamad Rafli</h3>

                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                </div>
                            </div>

                            <p class="text-[#606060] font-[400] text-[14px]">
                                The noodles were cooked just right, and the toppings were fresh and
                                generous. Definitely coming back for more
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide !w-fit">
                        <div
                            class="flex flex-col gap-3 w-[320px] border border-gray-200 hover:border-[#F3AF00] hover:bg-[#FFF7F0] hover:cursor-pointer rounded-[8px] p-4">
                            <div class="flex items-center justify-between gap-3">
                                <h3 class="text-[#353535] font-[500] text-[14px]">Muhamad Rafli</h3>

                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                </div>
                            </div>

                            <p class="text-[#606060] font-[400] text-[14px]">
                                The noodles were cooked just right, and the toppings were fresh and
                                generous. Definitely coming back for more
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <div
                            class="flex flex-col gap-3 w-[320px] border border-gray-200 hover:border-[#F3AF00] hover:bg-[#FFF7F0] hover:cursor-pointer rounded-[8px] p-4">
                            <div class="flex items-center justify-between gap-3">
                                <h3 class="text-[#353535] font-[500] text-[14px]">Muhamad Rafli</h3>

                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                </div>
                            </div>

                            <p class="text-[#606060] font-[400] text-[14px]">
                                The noodles were cooked just right, and the toppings were fresh and
                                generous. Definitely coming back for more
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide !w-fit">
                        <div
                            class="flex flex-col gap-3 w-[320px] border border-gray-200 hover:border-[#F3AF00] hover:bg-[#FFF7F0] hover:cursor-pointer rounded-[8px] p-4">
                            <div class="flex items-center justify-between gap-3">
                                <h3 class="text-[#353535] font-[500] text-[14px]">Muhamad Rafli</h3>

                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                    <img src="{{ asset('assets/images/icons/ic_star.svg') }}" alt="rating"
                                        class="w-4 h-4">
                                </div>
                            </div>

                            <p class="text-[#606060] font-[400] text-[14px]">
                                The noodles were cooked just right, and the toppings were fresh and
                                generous. Definitely coming back for more
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-x-0 bottom-0 max-w-[640px] z-50 bg-white shadow-sm mx-auto">
        <div class="flex items-center justify-between p-[20px]">
            <div class="flex flex-col  gap-2">
                <p class="text-[#606060] font-[400] text-[14px]">
                    Menu Price
                </p>
                <p class="font-[600] text-[18px]">
                    Rp {{ number_format($product->price) }}
                </p>
            </div>

            <button type="button"
                class="flex justify-center rounded-full p-[14px_28px] bg-[#FF801A] font-normal text-white"
                data-id="{{ $product->id }}" onclick="addToCart(this.dataset.id)">
                Add To Cart
            </button>
        </div>
    </div>
@endsection
