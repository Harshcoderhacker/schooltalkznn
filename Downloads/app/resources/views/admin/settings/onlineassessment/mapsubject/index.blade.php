@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Map Subject'])
@endsection

@section('subcontent')
    @livewire('admin.settings.onlineassessment.mapsubject.mapsubjectlivewire')
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'mapsubjectid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
