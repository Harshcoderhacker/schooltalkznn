@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Exams</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffexam',
        'name' => 'Exam',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffonlineassessment',
        'name' => 'Online Assessment',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Create Online Assessment',
    ])
@endsection

@section('subcontent')
    @livewire('staff.exam.onlineassessment.staffcreateonlineassessmentlivewire')

    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'exam_id'])
    <script>
        $('#staffexam').addClass("side-menu--active");
    </script>
@endsection
