@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminsettings',
        'name' => 'Settings',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Exam Pass Percentage',
    ])
@endsection

@section('subcontent')
    @livewire('admin.settings.examsettings.exampasspercentage.exampasspercentagelivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'exampasspercentageid'])
    <script>
        $('#adminsettings').addClass("side-menu--active");
    </script>
@endsection
