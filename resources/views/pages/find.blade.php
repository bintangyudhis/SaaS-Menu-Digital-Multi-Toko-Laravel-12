@extends('layouts.app')


@section('content')
    <div id="FindMenu" class="relative flex flex-col justify-center items-center mt-12 overflow-hidden p-5">
        <div class="bg-white flex items-center justify-center w-[180px] h-[180px] rounded-full">
            <img src="{{ asset('assets/images/photos/find-image.png') }}" alt="image" class="w-[150px] object-cover">
        </div>

        <h1 class="text-[#353535] font-[600] text-[24px] mt-6">Discover the unique flavors of food you like!</h1>

        <form action="{{ route('product.find-results', $store->username) }}"
            class="w-full flex flex-col rounded-[8px] border border-[#F1F2F6] p-5 gap-6 bg-white mt-6">
            @csrf
            <div id="InputContainer" class="flex flex-col gap-[18px]">
                <div class="flex flex-col w-full gap-2">
                    <p class="font-semibold">Name</p>
                    <label
                        class="flex items-center w-full rounded-[8px] p-[14px_20px] gap-3 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/images/icons/Document.svg') }}" class="w-5 h-5 flex shrink-0"
                            alt="icon">
                        <input type="text" name="search" id=""
                            class="appearance-none outline-none w-full font-regular placeholder:text-ngekos-grey placeholder:font-light"
                            placeholder="Type the menu name...">
                    </label>
                </div>
                <div class="flex flex-col w-full gap-2">
                    <p class="font-semibold">Choose Category</p>
                    <label
                        class="relative flex items-center w-full rounded-[8px] p-[14px_20px] gap-2 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/images/icons/Discovery.svg') }}"
                            class="absolute w-5 h-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        <select name="category" id="" class="appearance-none outline-none w-full bg-white pl-8">
                            <option value="" hidden>Select category</option>
                            @foreach ($store->productCategories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach


                        </select>
                        <img src="{{ asset('assets/images/icons/Arrow - Down 2.svg') }}" class="w-3 h-3" alt="icon">
                    </label>
                </div>
                <button type="submit"
                    class="flex w-full justify-center rounded-full p-[14px_20px] bg-[#FF801A] font-bold text-white">Explore
                    Now</button>
            </div>
        </form>
    </div>

    @include('includes.navigation')
@endsection
