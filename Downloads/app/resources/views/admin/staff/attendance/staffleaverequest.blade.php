@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'staffattendanceindex','name' => 'Attendance'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Leave Pending'])
@endsection

@section('subcontent')
    @livewire('admin.staff.attendance.staffleaverequestlivewire', [
    'panel' => "pending"
    ])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'leaverequestid'])
    <script>
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
