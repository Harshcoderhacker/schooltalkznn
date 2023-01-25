<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Fees and Expenses</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('feeparticular.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Fee Particular"
                                src="{{ asset('/image/settingsicon/fees/fee_particular.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Fee Particular
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('coa.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="COA"
                                src="{{ asset('/image/settingsicon/fees/coa.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">COA
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('feediscount.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="COA"
                                src="{{ asset('/image/settingsicon/fees/fee_discount.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Fee Discount
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
