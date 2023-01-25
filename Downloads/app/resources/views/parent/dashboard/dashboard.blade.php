@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Dashboard</title>
@endsection


@section('subcontent')
    @livewire('aparent.dashboard.dashboardlivewire')
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => "null"])
    <script>
        $('#parentdashboard').addClass("side-menu--active");
    </script>
@endsection
