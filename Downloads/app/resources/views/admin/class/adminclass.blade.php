@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminclass',
        'name' => 'Class',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Attendance',
    ])
@endsection

@section('subcontent')
    @livewire("admin.class.classlivewire")
@endsection

@section('script')
    <script>
        $('#adminclass').addClass("side-menu--active");
    </script>
@endsection
