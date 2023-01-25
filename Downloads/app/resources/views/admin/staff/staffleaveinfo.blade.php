@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', [
'flag' => 'inactive',
'url' => 'adminstaff',
'name' => 'Staff',
])
@include('helper.breadcrumb.breadcrumb', [
'flag' => 'active',
'name' => 'Staff Info',
])
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-5">
    <h2 class="text-lg font-medium mr-auto">Staff Info</h2>
</div>

<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    @include('admin.staff.staffinfotabhelper.staffcommondeatils')
    @include('admin.staff.staffinfotabhelper.staffinfotabhelper',['activestatus' =>'leaves'])
    @livewire('admin.staff.staffinfo.staffleavesinfolivewire',compact('staff'))
</div>
<!-- END: Profile Info -->
@endsection

@section('script')
<script>
    $('#adminstaff').addClass("side-menu--active");
</script>
@endsection