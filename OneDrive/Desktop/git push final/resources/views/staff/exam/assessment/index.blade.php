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
        'flag' => 'active',
        'name' => 'Online Assesment',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.onlineassessment.staffonlineassessmentindexlivewire')
@endsection

@section('script')
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
