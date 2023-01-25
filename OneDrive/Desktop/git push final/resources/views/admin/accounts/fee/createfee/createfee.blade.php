@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminfee',
        'name' => 'Fee',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'createadminfeeindex',
        'name' => 'Fees Data',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Create Fee',
    ])
@endsection

@section('subcontent')
    @livewire('admin.accounts.fee.createfeelivewire', ['feemaster_id' => $feemaster->id, 'show' => $show])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
