@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminstaff',
        'name' => 'Staff',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffattendanceindex',
        'name' => 'Attendance',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Smart Attendance',
    ])
@endsection

@section('subcontent')
    <livewire:staff.smartattendance.smartattendanceindexlivewire :date="false" />
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'smartattendanceid'])
    <script>
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
