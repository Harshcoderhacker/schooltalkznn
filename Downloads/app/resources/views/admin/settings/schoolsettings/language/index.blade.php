@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Language'])
@endsection

@section('subcontent')
    @livewire('admin.settings.schoolsettings.language.languageliverwire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    @include('helper.toaster.toasterscript', ['deleteid' => 'languageid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
