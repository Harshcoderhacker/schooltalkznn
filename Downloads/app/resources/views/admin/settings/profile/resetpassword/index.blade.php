@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminsettings','name' => 'Settings'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Reset Password'])
@endsection

@section('subcontent')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        <!-- BEGIN: Chat Side Menu -->


        @include('admin.settings.profile.helper.profilesettingsmenu', ['active' => 'resetpassword'])
        @livewire('admin.settings.profile.changepasswordlivewire')
        {{-- Toaster --}}
        @include('helper.toaster.toasternotification')


    </div>
@endsection

@section('script')
    {{-- Toaster --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'academicyearid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
