@extends('layouts.app')

@section('content')
    <div id="Background"
        class="absolute top-0 w-full h-[170px] rounded-b-[45px] bg-[linear-gradient(90deg,#FF923C_0%,#FF801A_100%)]">
    </div>

    <div id="TopNav" class="relative flex flex-col px-5 mt-[20px] h-[170px]">
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <p class="text-white text-sm">Welcome To,</p>
                <h1 class="text-white font-semibold">{{ $store->name }}</h1>
            </div>
            <a href="#"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white bg-opacity-20">
                <img src="assets/images/icons/ic_bell.svg" class="w-[28px] h-[28px]" alt="icon">
            </a>
        </div>

        <h1 class="text-white font-[600] text-2xl leading-[30px] mt-[20px]">Order Delicious Meal!</h1>

        <div class="absolute bottom-0 left-0 right-0 w-full gap-2 px-5">
            <label
                class="flex items-center w-full rounded-full p-[8px_8px] gap-3 bg-white ring-1 ring-[#F1F2F6] focus-within:ring-[#F3AF00] transition-all duration-300">
                <img src="assets/images/icons/ic_search.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                <input type="text" name="search" id=""
                    class="appearance-none outline-none w-full font-semibold placeholder:text-ngekos-grey placeholder:font-light"
                    placeholder="Search menu, or etc...">
            </label>
        </div>
    </div>

    <div id="Categories" class="relative flex flex-col px-5 mt-[20px]">
        <div class="flex items-end justify-between ">
            <h1 class="text-[#353535] font-[500] text-lg">Explore Categories</h1>
            <a href="#" class="text-[#FF801A] text-sm ">See All</a>
        </div>

        <div class="swiper w-full">
            <div class="swiper-wrapper mt-[20px]">
                @foreach ($store->productCategories as $category)
                    <a href="#" class="swiper-slide !w-fit">
                        <div class="flex flex-col items-center shrink-0 gap-2 text-center">
                            <div
                                class="w-[64px] h-[64px] rounded-full flex shrink-0 overflow-hidden p-4 bg-[#9393931A] bg-opacity-10">
                                <img src="{{ asset('storage/'. $category->icon) }}" class="w-full h-full object-contain"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <h3 class="font-light text-[#504D53] text-[14px]">{{ $category->name }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div id="Favorites" class="relative flex flex-col px-5 mt-[20px]">
        <div class="flex items-end justify-between">
            <h1 class="text-[#353535] font-[500] text-lg">Menu Favorite</h1>
            <a href="#" class="text-[#FF801A] text-sm ">See All</a>
        </div>

        <div class="swiper w-full">
            <div class="swiper-wrapper mt-[10px]">
                @foreach ($populars as $popular)
                    <div class="swiper-slide !w-fit">
                    <a href="details.html" class="card">
                        <div
                            class="flex flex-col w-[210px] shrink-0 rounded-[8px] bg-white p-[12px] pb-5 gap-[10px] hover:bg-[#FFF7F0] hover:border-[1px] hover:border-[#F3AF00] transition-all duration-300 cursor-pointer">
                            <div
                                class="position-relative flex w-full h-[150px] shrink-0 rounded-[8px] bg-[#D9D9D9] overflow-hidden">
                                <img src="{{'storage/'. $popular->image }}" class="w-full h-full object-cover"
                                    alt="thumbnail">

                                <!-- rating -->
                                <div
                                    class="absolute top-5 right-5 flex items-center gap-1 bg-white px-[8px] py-[4px] rounded-full">
                                    <img src="assets/images/icons/ic_star.svg" alt="rating" class="w-4 h-4">
                                    <p class="text-sm">{{ $popular->rating }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-[#F3AF00] font-[400] text-[12px]">
                                    {{ $popular->productCategory->name }}
                                </p>
                                <h3 class="text-[#353535] font-[500] text-[14px]">
                                    {{ $popular->name }}
                                </h3>
                                <p class="text-[#606060] font-[400] text-[10px]">
                                    {{ $popular->description }}
                                </p>

                            </div>

                            <div class="flex items-center justify-between ">
                                <p class="text-[#FF001A] font-[600] text-[14px]">
                                    Rp {{ number_format($popular->price) }}
                                </p>
                                <button type="button"
                                    class="flex items-center justify-center w-[24px] h-[24px] rounded-full bg-transparent"
                                    data-id="{{ $popular->id }}" onclick="addToCart(this.dataset.id)">
                                    <img src="assets/images/icons/ic_plus.svg" class="w-full h-full" alt="icon">
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="Recomendations" class="relative flex flex-col px-5 mt-[20px]">
        <div class="flex items-end justify-between ">
            <h1 class="text-[#353535] font-[500] text-lg">Chef's Recommendations</h1>
            <a href="#" class="text-[#FF801A] text-sm ">See All</a>
        </div>
        <div class="flex flex-col gap-4 mt-[10px]">

            @foreach ($products as $product )
                <a href="details.html" class="card">
                <div
                    class="flex rounded-[8px] border border-[#F1F2F6] p-[12px] gap-4 bg-white hover:bg-[#FFF7F0] hover:border-[1px] hover:border-[#F3AF00] transition-all duration-300">
                    <img src="{{ asset('storage/'. $product->image) }}" class="w-[128px] object-cover rounded-[8px]"
                        alt="icon">
                    <div class="flex flex-col gap-1 w-full">
                        <p class="text-[#F3AF00] font-[400] text-[12px]">
                            {{ $product->productCategory->name }}
                        </p>
                        <h3 class="text-[#353535] font-[500] text-[14px]">
                            {{ $product->name }}
                        </h3>
                        <p class="text-[#606060] font-[400] text-[10px]">
                            {{ $product->description }}
                        </p>

                        <div class="flex items-center justify-between ">
                            <p class="text-[#FF001A] font-[600] text-[14px]">
                                RP {{ number_format($product->price) }}
                            </p>
                            <button type="button"
                                class="flex items-center justify-center w-[24px] h-[24px] rounded-full bg-transparent"
                                data-id="{{ $product->id }}" onclick="addToCart(this.dataset.id)">
                                <img src="assets/images/icons/ic_plus.svg" class="w-full h-full" alt="icon">
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>

    @include('includes.navigation')
@endsection
