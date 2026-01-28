@extends('layouts.app')


@section('content')
    <div id="TopNav" class="relative flex items-center justify-between px-5 py-3 bg-white">
        <a href="{{ route('cart', $store->username) }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#F0F1F3]">
            <img src="{{ asset('assets/images/icons/Arrow - Left.svg') }}" class="w-[28px] h-[28px]" alt="icon">
        </a>
        <p class="font-semibold">Customer Information</p>
        <div class="dummy-btn w-12"></div>
    </div>

    <div id="Cart" class="flex flex-col gap-4 mt-[10px] px-5">
        @foreach ($store->products as $product)
            <div class="cart-item flex gap-4 flex-col rounded-[8px] border border-[#F1F2F6] p-[12px]  bg-white hover:bg-[#FFF7F0] hover:border-[1px] hover:border-[#F3AF00] transition-all duration-300"
                data-id="{{ $product->id }}">
                <div class="flex gap-4">
                    <div class="w-[128px] h-[88px]">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full object-cover rounded-[8px]"
                            alt="icon">
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <div class="flex items-center justify-between">
                            <p class="text-[#F3AF00] font-[400] text-[12px]">
                                {{ $product->productCategory->name }}
                            </p>
                        </div>
                        <h3 class="text-[#353535] font-[500] text-[14px]">
                            {{ $product->name }}
                        </h3>
                        <p class="text-[#606060] font-[400] text-[10px]">
                            {{ $product->description }}
                        </p>
                        <div class="flex items-center justify-between ">
                            <p class="text-[#FF001A] font-[600] text-[14px]" data-id="{{ $product->id }}" id="price">
                                Rp {{ number_format($product->price) }}
                            </p>
                            <div class="flex items-center gap-2 ">
                                <p class="text-[#FF001A] font-[600] text-[14px]" data-id="{{ $product->id }}"
                                    id="qty">
                                    1
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <label
                    class="flex items-center w-full rounded-[8px] p-[8px] gap-3 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                    <img src="{{ asset('assets/images/icons/Edit.svg') }}" class="w-5 h-5 flex shrink-0" alt="icon">
                    <input type="text" name="notes" id="notes" data-id="{{ $product->id }}"
                        class="appearance-none outline-none w-full font-regular placeholder:text-ngekos-grey placeholder:font-normal"
                        placeholder="Write notes..." readonly>
                </label>
            </div>
        @endforeach

        <form action="{{ route('payment', $store->username) }}" id="Form" method="POST">
            @csrf
            <div id="Informations" class="relative flex flex-col px-5">
                <div class="w-full flex flex-col rounded-[8px] border border-[#F1F2F6] p-5 gap-6 bg-white mt-6">
                    <input type="hidden" name="cart" id="cart-data">
                    <div id="InputContainer" class="flex flex-col gap-[18px]">
                        <div class="flex flex-col w-full gap-2">
                            <p class="font-semibold">Name</p>
                            <label
                                class="flex items-center w-full rounded-[8px] p-[14px_20px] gap-3 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/Document.svg') }}" class="w-5 h-5 flex shrink-0"
                                    alt="icon">
                                <input type="text" name="name" id=""
                                    class="appearance-none outline-none w-full font-regular placeholder:text-ngekos-grey placeholder:font-light"
                                    placeholder="Enter your name..." required>
                            </label>
                        </div>

                        <div class="flex flex-col w-full gap-2">
                            <p class="font-semibold">Phone Number</p>
                            <label
                                class="flex items-center w-full rounded-[8px] p-[14px_20px] gap-3 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/Call.svg') }}" class="w-5 h-5 flex shrink-0"
                                    alt="icon">
                                <input type="text" name="phone_number" id=""
                                    class="appearance-none outline-none w-full font-regular placeholder:text-ngekos-grey placeholder:font-light"
                                    placeholder="Enter your phone number..." required>
                            </label>
                        </div>

                        <div class="flex flex-col w-full gap-2">
                            <p class="font-semibold">Table Number</p>
                            <label
                                class="flex items-center w-full rounded-[8px] p-[14px_20px] gap-3 bg-white ring-1 ring-[#F3AF003D] ring-opacity-5 focus-within:ring-[#F3AF00] focus-within:ring-opacity-100 transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/Document.svg') }}" class="w-5 h-5 flex shrink-0"
                                    alt="icon">
                                <input type="text" name="table_number" id=""
                                    class="appearance-none outline-none w-full font-regular placeholder:text-ngekos-grey placeholder:font-light"
                                    placeholder="Enter your table number...." required>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="PaymentMethods" class="relative flex flex-col px-5">
                <div class="w-full flex flex-col rounded-[8px] border border-[#F1F2F6] p-5 gap-6 bg-white mt-6">
                    <div id="InputContainer" class="flex flex-col gap-[18px]">
                        <p class="font-semibold">Payment Method</p>

                        <div class="flex w-full gap-3">
                            <div class="flex items-center gap-2 rounded-[16px] p-[18px_28px] bg-[#F1F2F6] font-normal text-[#353535] w-full hover:cursor-pointer"
                                onclick="selectPayment('cash')" id="cash">
                                <input type="radio" name="payment_method" id="cash" class="peer hidden"
                                    value="cash" required>
                                <p class="font-semibold">Cash</p>
                            </div>

                            <div class="flex items-center gap-2 rounded-[16px] p-[18px_28px] bg-[#F1F2F6] font-normal text-[#353535] w-full hover:cursor-pointer"
                                onclick="selectPayment('midtrans')" id="midtrans">
                                <input type="radio" name="payment_method" id="midtrans" class="peer hidden"
                                    value="midtrans" required>
                                <p class="font-semibold">Midtrans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed inset-x-0 bottom-0 max-w-[640px] z-50 bg-white shadow-sm mx-auto">
                <div class="flex items-center justify-between p-[20px]">
                    <div class="flex flex-col  gap-2">
                        <p class="text-[#606060] font-[400] text-[14px]">
                            Total Price
                        </p>
                        <p class="font-[600] text-[18px]" id="totalAmount">
                            Rp 0
                        </p>
                    </div>

                    <button type="submit"
                        class="flex justify-center rounded-full p-[14px_28px] bg-[#FF801A] font-normal text-white">
                        Payment
                    </button>
                </div>
            </div>
        </form>
    @endsection

    @section('script')
        <script src="{{ asset('assets/js/customer-information.js') }}"></script>
    @endsection
