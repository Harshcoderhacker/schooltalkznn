@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Examination</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'parentexam',
        'name' => 'Examination',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Exam Progress Card',
    ])
@endsection

@section('subcontent')
    @livewire('aparent.exam.parentexamprogresscardlivewire')
@endsection

@section('script')
    <script>
        $('#parentexam').addClass("side-menu--active");
    </script>
@endsection
