<div class="col-start-3 col-end-11 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('source.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'source' ? 'bg-primary text-white' : '' }}">Source</a>
                <a href="{{ route('reference.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'reference' ? 'bg-primary text-white' : '' }}">Reference</a>
                <a href="{{ route('complainttype.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'complainttype' ? 'bg-primary text-white' : '' }}">Complaint
                    Type</a>
                <a href="{{ route('purpose.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'purpose' ? 'bg-primary text-white' : '' }}">Purpose</a>
            </div>
        </div>
    </div>
</div>