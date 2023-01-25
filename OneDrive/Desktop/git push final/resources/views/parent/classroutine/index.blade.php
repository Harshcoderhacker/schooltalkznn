@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Class Routine</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Class Routine'])
@endsection


@section('subcontent')
    @livewire('aparent.classroutine.classroutineparentlivewire')
@endsection

@section('script')
    <script>
        $('#parentclassrountine').addClass("side-menu--active");
    </script>
@endsection
