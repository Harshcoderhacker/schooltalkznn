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
        'name' => 'Online Assesment',
    ])
@endsection

@section('subcontent')
    @livewire('aparent.exam.onlineassessment.parentonlineassessmentsummarylivewire', ['onlineassessment_id' => $onlineassessment_id])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'onlineassessmentid'])
    <script>
        $('#parentexam').addClass("side-menu--active");
    </script>
@endsection
