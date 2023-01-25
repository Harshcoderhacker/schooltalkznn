@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Class Routine</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Class Routine',
    ])
@endsection


@section('subcontent')
    @livewire('staff.classroutine.classroutinestafflivewire',['staff_id' => null])
@endsection

@section('script')
    <script>
        $('#staffmyclassroutine').addClass("side-menu--active");
    </script>
@endsection
