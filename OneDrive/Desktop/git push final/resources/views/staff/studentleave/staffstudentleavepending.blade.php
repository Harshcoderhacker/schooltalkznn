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
        'name' => 'Leave Pending',
    ])
@endsection

@section('subcontent')
    @livewire('admin.student.attendance.adminstudentleaverequestlivewire',[
    'platform' => 'staff',
    ])
@endsection

@section('script')
    <script>
        $('#staffstudentindex').addClass("side-menu--active");
    </script>
@endsection
