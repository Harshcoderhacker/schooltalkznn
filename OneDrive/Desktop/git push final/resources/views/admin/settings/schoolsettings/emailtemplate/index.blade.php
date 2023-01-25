@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Email Template'])
@endsection

@section('subcontent')
    @livewire('admin.settings.schoolsettings.emailtemplate.emailtemplateliverwire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'emailtemplateid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
