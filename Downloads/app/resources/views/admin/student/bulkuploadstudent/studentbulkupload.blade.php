@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Students</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=>'adminstudent', 'name' => 'Student'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Buld Upload'])
@endsection

@section('subcontent')
    @livewire('admin.student.studentbulkuploadlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'null'])
    <script>
        $('#adminstudent').addClass("side-menu--active");
    </script>
@endsection
