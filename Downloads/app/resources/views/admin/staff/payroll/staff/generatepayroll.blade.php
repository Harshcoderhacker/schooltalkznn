@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive','url'=> 'payroll', 'name' => 'Payroll'])
<li class="breadcrumb-item" aria-current="page">
    <a href="{{ route('payrollstafflist',$payrollid) }}" class=""> Staff List</a>
</li>
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Staff Details'])

@endsection

@section('subcontent')
@livewire('admin.staff.payroll.payrollgeneratelivewire',[
'staffpayrollid' => $staffpayrollid,
])
{{-- Toaster --}}
@include('helper.toaster.toasternotification')
@endsection

@section('script')
{{-- Toaster Script --}}
@include('helper.toaster.toasterscript', ['deleteid' => 'staffpayrollid'])
<script>
    $('#adminstaff').addClass("side-menu--active");
</script>
@endsection