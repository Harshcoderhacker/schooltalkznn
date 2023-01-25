@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffclass',
        'name' => 'Class',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Attendance',
    ])
@endsection

@section('subcontent')
    @livewire("staff.class.staffclasslivewire")
@endsection

@section('script')
    <script>
        $('#staffclass').addClass("side-menu--active");
    </script>
@endsection
