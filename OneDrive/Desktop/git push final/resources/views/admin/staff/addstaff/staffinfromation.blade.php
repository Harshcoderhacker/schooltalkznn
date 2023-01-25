@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Add Staff'])
@endsection

@section('subcontent')
    @livewire('admin.staff.addstafflivewire',[
    'staff'=>$staff,
    'show'=>$show,
    ])
@endsection

@section('script')
    <script>
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
