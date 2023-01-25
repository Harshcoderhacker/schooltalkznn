@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Fee Particular'])
@endsection

@section('subcontent')
    @livewire('admin.settings.feesettings.feeparticular.feeparticularliverwire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'feeparticularid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
