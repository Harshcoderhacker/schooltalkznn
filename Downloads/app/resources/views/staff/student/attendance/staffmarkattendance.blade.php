@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Students</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffstudentindex',
        'name' => 'Student',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffstudentleaveindex',
        'name' => 'Attendance & Leaves',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Mark Attendance',
    ])
@endsection

@section('subcontent')
    @livewire('admin.student.attendance.admintakestudentattendancelivewire',[
    'studentattendanceid' => $studentattendanceid,
    'platform' => 'staff',
    ])
@endsection
@section('script')
    <script>
        $('#staffstudentindex').addClass("side-menu--active");
    </script>
@endsection
