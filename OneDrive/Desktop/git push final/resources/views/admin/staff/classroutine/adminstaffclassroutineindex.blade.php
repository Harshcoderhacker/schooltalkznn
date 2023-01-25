@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminstaff',
        'name' => 'Staff',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Class Routine',
    ])
@endsection

@section('subcontent')
    @livewire('admin.staff.classroutine.adminstaffclassroutineindexlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'staffclassroutineid'])
    <script>
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
