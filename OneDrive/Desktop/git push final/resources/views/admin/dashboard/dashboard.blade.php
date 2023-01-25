@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Dashboard {{ App::make('generalsetting')->schoolname }}</title>
@endsection


@section('subcontent')
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        @include('admin.dashboard.dashboardtab', ['activestatus' => 'admindashboard'])

        <div class="tab-content">
            <div id="dashboard" role="tabpanel">
                @livewire('admin.dashboard.dashboardlivewire')
            </div>
        </div>
    </div>
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
{{-- Toaster Script --}}
@include('helper.toaster.toasterscript', ['deleteid' => 'feedid'])
<script>
    $('#admindashboard').addClass("side-menu--active");
</script>
@endsection
