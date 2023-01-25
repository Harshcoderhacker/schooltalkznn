@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'User Activity Logs'])
@endsection

@section('subcontent')
    @livewire('admin.settings.logs.useractivitylogs.useractivitylogslivewire')
@endsection

@section('script')
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
