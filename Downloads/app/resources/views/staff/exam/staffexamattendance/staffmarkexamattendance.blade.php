 @extends('../layout/staff/' . $layout)

 @section('subhead')
     <title>Edfish - Exam</title>
 @endsection

 @section('breadcrumb')
     @include('helper.breadcrumb.breadcrumb', [
         'flag' => 'inactive',
         'url' => 'staffexam',
         'name' => 'Exams',
     ])
     @include('helper.breadcrumb.breadcrumb', [
         'flag' => 'inactive',
         'url' => 'staffexamattendance',
         'name' => 'Attendance',
     ])
     @include('helper.breadcrumb.breadcrumb', [
         'flag' => 'active',
         'name' => 'Attendance',
     ])
 @endsection

 @section('subcontent')
     @livewire('staff.exam.examattendance.staffmarkexamattendancelivewire',[
     'examid' => $examid,'subjectid' => $subjectid, 'classmasterid'=>$classmasterid, 'sectionid'=>$sectionid
     ])
 @endsection

 @section('script')
     <script>
         $('#staffhomework').addClass("side-menu--active");
     </script>
 @endsection
