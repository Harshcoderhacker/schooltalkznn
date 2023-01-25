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
        'flag' => 'inactive',
        'url' => 'staffmarkentry',
        'name' => 'Mark Entry',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Do Mark Entry',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.exammark.staffexammarkentrylivewire',[
    'examid' => $examid,'subjectid' => $subjectid, 'classmasterid'=>$classmasterid, 'sectionid'=>$sectionid
    ])
@endsection

@section('script')
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
