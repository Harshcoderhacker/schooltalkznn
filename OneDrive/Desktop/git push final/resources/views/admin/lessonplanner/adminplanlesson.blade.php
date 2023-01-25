@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Lesson Planner</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminlessonplanner',
        'name' => 'Lesson Planner',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Plan Lesson',
    ])
@endsection

@section('subcontent')
    @livewire('admin.lessonplanner.lessonplannerlivewire',['platform' => 'admin', 'duelesson_id' => $duelesson_id])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection
@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'uuid'])
@endsection
