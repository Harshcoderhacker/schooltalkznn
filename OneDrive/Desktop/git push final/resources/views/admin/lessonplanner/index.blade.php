@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Lesson Planner</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Lesson Planner',
    ])
@endsection

@section('subcontent')
    @livewire('admin.lessonplanner.lessonplannerindexlivewire')
@endsection
