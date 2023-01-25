@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Students</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=>'adminstudent', 'name' => 'Student'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Add Student'])
@endsection

@section('subcontent')
    @livewire('admin.student.addstudent.addstudentlivewire',[
    'student'=>$student,
    'show'=>$show])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'null'])
    <script>
        $('#adminstudent').addClass("side-menu--active");
    </script>
@endsection
