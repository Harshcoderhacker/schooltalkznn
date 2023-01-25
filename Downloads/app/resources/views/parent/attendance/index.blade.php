@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Attendance</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Attendance'])
@endsection

@section('subcontent')
    @livewire('aparent.attendance.parentattendanceindexlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'applyleaveid'])
    <script>
        $('#parentattendance').addClass("side-menu--active");
    </script>
@endsection
