@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=>'adminstaff', 'name' => 'Staff'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Bulk Upload'])
@endsection

@section('subcontent')
@livewire('admin.staff.staffbulkuploadlivewire')
{{-- Toaster --}}
@include('helper.toaster.toasternotification')
@endsection

@section('script')
{{-- Toaster Script --}}
@include('helper.toaster.toasterscript', ['deleteid' => 'null'])
<script>
    $('#adminstaff').addClass("side-menu--active");
</script>
@endsection