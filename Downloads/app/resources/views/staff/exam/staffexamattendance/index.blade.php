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
        'flag' => 'active',
        'name' => 'Attendance',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.examattendance.staffexamattendancelivewire')
@endsection

@section('script')
    <script>
        $('#staffhomework').addClass("side-menu--active");
    </script>
@endsection
