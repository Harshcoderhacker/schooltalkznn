@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'staffattendanceindex','name' => 'Attendance &
    Leaves'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Mark Attendance'])
@endsection

@section('subcontent')
    @livewire('admin.staff.attendance.adminstaffmarkattendancelivewire', [
    "staffattendanceid" => $staffattendanceid
    ])
@endsection

@section('script')
    <script>
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
