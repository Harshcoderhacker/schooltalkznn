@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Students</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', [
'flag' => 'inactive',
'url' => 'adminstudent',
'name' => 'Student',
])
@include('helper.breadcrumb.breadcrumb', [
'flag' => 'active',
'name' => 'Student Details',
])
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-5">
    <h2 class="text-lg font-medium mr-auto">Student Info</h2>
</div>
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    @include('admin.student.studentdetailstab.studentcommondetails')
    @include('admin.student.studentdetailstab.studentsdetailstabhelper',['activestatus' =>'fees'])
    @livewire('admin.student.studentfeedetailslivewire',compact('student'))
</div>

@endsection

@section('script')
<script>
    $('#adminstudent').addClass("side-menu--active");
</script>
@endsection