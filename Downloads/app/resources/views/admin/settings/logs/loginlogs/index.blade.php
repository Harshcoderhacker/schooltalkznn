@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Login Logs'])
@endsection

@section('subcontent')
    @livewire('admin.settings.logs.loginlogs.loginlogslivewire')
@endsection

@section('script')
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
