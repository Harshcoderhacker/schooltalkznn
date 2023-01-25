@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Exams</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffexam',
        'name' => 'Exams',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffmarkentry',
        'name' => 'Mark Entry',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'View Mark',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.exammark.staffviewxammarklivewire',['examid' => $examid,'subjectid' => $subjectid])
@endsection

@section('script')
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
