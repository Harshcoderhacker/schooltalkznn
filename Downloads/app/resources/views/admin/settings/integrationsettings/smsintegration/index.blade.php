@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'SMS Integration'])
@endsection

@section('subcontent')
    @livewire('admin.settings.integrationsettings.smsintegration.smsintegrationliverwire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')

    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'smsintegrationid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
