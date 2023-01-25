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
        'name' => 'Mark Entry',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.exammark.staffexammarklivewire')
@endsection

@section('script')
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
