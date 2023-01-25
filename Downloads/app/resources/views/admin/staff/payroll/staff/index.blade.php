@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive','url'=> 'payroll', 'name' => 'Payroll'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Staff List'])

@endsection

@section('subcontent')
@livewire('admin.staff.payroll.payrolleachmonthlistlivewire',['payrollid' => $payrollid,])
{{-- Toaster --}}
@include('helper.toaster.toasternotification')
@endsection

@section('script')
{{-- Toaster Script --}}
@include('helper.toaster.toasterscript', ['deleteid' => 'payrolleachmonthid'])
<script>
    $('#adminstaff').addClass("side-menu--active");
</script>
@endsection