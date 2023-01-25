<div class="col-start-5 col-end-9 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('feeparticular.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feeparticular' ? 'bg-primary text-white' : '' }}">Fee
                    Particular</a>
                <a href="{{ route('coa.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'coa' ? 'bg-primary text-white' : '' }}">COA</a>
                <a href="{{ route('feediscount.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feediscount' ? 'bg-primary text-white' : '' }}">Fee
                    Discount</a>
            </div>
        </div>
    </div>
</div>
