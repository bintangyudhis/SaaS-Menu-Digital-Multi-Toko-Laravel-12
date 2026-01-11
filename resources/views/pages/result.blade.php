@extends('layouts.app')

@section('content')
    <div id="TopNav" class="relative flex items-center justify-between px-5 py-3 bg-white">
        <a href="{{ route('product.find', $store->username) }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#F0F1F3]">
            <img src="{{ asset('assets/images/icons/Arrow - Left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Search Results</p>
        <div class="dummy-btn w-12"></div>
    </div>

    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col gap-[6px]">
            <h1 class="text-[20px]">Search Result</h1>
            <p class="text-[#606060] text-[12px]">{{ $products->count() }} Menus Available</p>
        </div>
    </div>

    <!-- search result -->
    <div id="SearchResult" class="flex flex-col gap-4 mt-[10px] px-5">
        @foreach ($products as $product)
            <a href="" class="card">
                <div
                    class="flex rounded-[8px] border border-[#F1F2F6] p-[12px] gap-4 bg-white hover:bg-[#FFF7F0] hover:border-[1px] hover:border-[#F3AF00] transition-all duration-300">
                    <div class="w-[128px] h-[88px]">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-full h-full object-cover rounded-[8px]" alt="icon">
                    </div>
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
                                Rp {{ number_format($product->price) }}
                            </p>
                            <button type="button"
                                class="flex items-center justify-center w-[24px] h-[24px] rounded-full bg-transparent"
                                data-id="{{ $product->id }}" onclick="addToCart(this.dataset.id)">
                                <img src="{{ asset('assets/images/icons/ic_plus.svg') }}" class="w-full h-full"
                                    alt="icon">
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @include('includes.navigation')
@endsection
