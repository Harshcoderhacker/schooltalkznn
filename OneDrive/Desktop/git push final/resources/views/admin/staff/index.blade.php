@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Staff'])
@endsection

@section('subcontent')
    @livewire('admin.staff.staffindexlivewire')
@endsection
