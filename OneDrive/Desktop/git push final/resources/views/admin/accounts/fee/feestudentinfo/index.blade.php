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
        'flag' => 'active',
        'name' => 'Fee Student Information',
    ])
@endsection

@section('subcontent')
    @livewire('admin.accounts.feestudentinfo.feestudentinfoindexlivewire',['student' => $student])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
@endsection
