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
        'url' => 'exammarkentry',
        'name' => 'Mark Entry',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'View Mark',
    ])
@endsection

@section('subcontent')
    @livewire('admin.exam.exammark.examviewmarklivewire',[
    'examid' => $examid,'subjectid' => $subjectid
    ])
@endsection

@section('script')
    <script>
        $('#adminexam').addClass("side-menu--active");
    </script>
@endsection
