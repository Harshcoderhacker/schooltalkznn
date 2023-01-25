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
        'flag' => 'active',
        'name' => 'Attendance & Leaves',
    ])
@endsection

@section('subcontent')
    @livewire('admin.student.attendance.adminstudentattendanceindexlivewire', ['platform' => 'staff'])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'null'])
    <script>
        $('#staffstudentindex').addClass("side-menu--active");
    </script>
@endsection
