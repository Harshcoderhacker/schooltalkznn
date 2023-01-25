@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Exams</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminexam',
        'name' => 'Exams',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'examattendance',
        'name' => 'Exam Attendance',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Mark Exam Attendance',
    ])
@endsection

@section('subcontent')
    @livewire('admin.exam.examattendance.markexamattendancelivewire',[
    'examid' => $examid,'subjectid' => $subjectid
    ])
@endsection

@section('script')
    <script>
        $('#adminexam').addClass("side-menu--active");
    </script>
@endsection
