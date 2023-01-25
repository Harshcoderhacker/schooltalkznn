@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Time Table'])
@endsection

@section('subcontent')
    @livewire('admin.settings.academicsettings.timetable.timetablelivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'classroutineid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
