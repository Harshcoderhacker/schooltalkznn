@extends('../layout/staff/' . $layout)

@section('subhead')
<title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffvirtualclass',
        'name' => 'Virtual Class',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Create Virtual Class',
    ])
@endsection


@section('subcontent')
<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4">
    <div class="text-center text-xl	mt-3 text-theme-1 font-semibold">
        Create Virtual Class/Meeting
    </div>
    <div class="w-full mx-auto sm:w-2/3">
        <div class="px-5 sm:px-20 mt-2 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Host</label>
                    <input id="input-wizard-2" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Meeting For</label>
                    <input id="input-wizard-3" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Class Name</label>
                    <input id="input-wizard-2" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Section</label>
                    <input id="input-wizard-3" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Date</label>
                    <input id="input-wizard-2" type="date" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">Recurring</label>
                    <input id="input-wizard-3" type="text" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-2" class="form-label font-semibold">Start Time</label>
                    <input id="input-wizard-2" type="time" class="form-control">
                </div>
                <div class="intro-x col-span-12 sm:col-span-6">
                    <label for="input-wizard-3" class="form-label font-semibold">End Time</label>
                    <input id="input-wizard-3" type="time" class="form-control">
                </div>
                <div class="intro-x col-span-12 flex items-center justify-center mt-5 mb-5">
                    <a href="{{route('staffvirtualclass')}}" class="btn btn-danger w-24">Cancel</a>
                    <a href="{{route('staffvirtualclass')}}" class="btn btn-primary w-24 ml-2">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#staffvirtualclass').addClass("side-menu--active");
</script>
@endsection