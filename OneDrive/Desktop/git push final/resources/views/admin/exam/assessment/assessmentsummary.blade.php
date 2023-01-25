@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Exams</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminexam',
        'name' => 'Exam',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'onlineassessment',
        'name' => 'Online Assessment',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Online Assessment Summary',
    ])
@endsection

@section('subcontent')
    @livewire('admin.exam.onlineassessment.assessmentsummarylivewire',['assessmentid'=>$assessmentid])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'exam_id'])
    <script>
        $('#adminexam').addClass("side-menu--active");
    </script>
@endsection
