@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'General'])
@endsection

@section('subcontent')
        @livewire('admin.settings.schoolsettings.general.generallivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'null'])
    {{-- passing something to avoid error --}}
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
