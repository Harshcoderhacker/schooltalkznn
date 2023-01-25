@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Map Class'])
@endsection

@section('subcontent')
    @livewire('admin.settings.onlineassessment.mapclass.mapclasslivewire')
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'mapclassid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
