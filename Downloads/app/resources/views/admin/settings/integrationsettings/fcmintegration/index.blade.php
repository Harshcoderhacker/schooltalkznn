@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'FCM Integration'])
@endsection

@section('subcontent')

    @livewire('admin.settings.integrationsettings.fcmintegration.fcmintegrationliverwire')

    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')

@endsection

@section('script')

    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'fcmintegrationid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
