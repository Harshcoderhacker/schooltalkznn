@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Exams</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Exams'])
@endsection

@section('subcontent')
    @livewire('admin.exam.examindexlivewire')
@endsection

@section('script')
    <script>
        $('#adminexam').addClass("side-menu--active");
    </script>
@endsection
