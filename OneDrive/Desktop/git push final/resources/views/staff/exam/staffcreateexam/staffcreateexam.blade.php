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
        'flag' => 'inactive',
        'url' => 'staffcreateexamindex',
        'name' => 'View Exams',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Create Exams',
    ])
@endsection


@section('subcontent')
    @livewire('staff.exam.createexam.staffcreateexamlivewire',['exam_id' =>$exam->id,
    'show'=>$show])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'examid'])
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
