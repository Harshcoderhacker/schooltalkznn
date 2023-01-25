@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Exam</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Exams',
    ])
@endsection


@section('subcontent')
    @livewire('staff.exam.staffexamindexlivewire')
@endsection

@section('script')
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
