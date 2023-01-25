@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Dashboard</title>
@endsection


@section('subcontent')
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>

        @include('admin.dashboard.dashboardtab', [
            'activestatus' => 'schooltalkz_dashboard',
        ])

        <div class="tab-content">
            <div role="tabpanel">
                @livewire('admin.dashboard.schooltalkzdashboardlivewire')
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $('#admindashboard').addClass("side-menu--active");
        </script>
    @endsection
