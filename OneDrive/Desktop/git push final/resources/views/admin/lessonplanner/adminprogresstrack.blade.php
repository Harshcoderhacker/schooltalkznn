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
        'name' => 'Progress Track',
    ])
@endsection

@section('subcontent')
    @livewire('admin.lessonplanner.progresstracklivewire')
@endsection
