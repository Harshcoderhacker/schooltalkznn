@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Assign Subjects'])
@endsection

@section('subcontent')
    @livewire('admin.settings.academicsettings.assignsubject.assignsubjectliverwire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'assignsubjectid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");

    </script>

@endsection
