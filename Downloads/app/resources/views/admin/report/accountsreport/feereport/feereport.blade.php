<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">Fee Report</h2>
</div>
<div class="grid grid-cols-12 gap-y-5 sm:gap-6 mt-5">
    <a href="{{ route('feestatementreport') }}" class="col-span-12 sm:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/fee_statement.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Fee Statement
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('feeduereport') }}" class="col-span-12 sm:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/fee_due.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Fee Due
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('feetransactionreport') }}" class="col-span-12 sm:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/fee_transaction.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Fee Transaction
                </div>
            </div>
        </div>
    </a>
</div>
