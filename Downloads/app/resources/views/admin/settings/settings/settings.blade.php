@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Settings</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Settings'])
@endsection

@section('subcontent')
    <div class="w-full mx-auto sm:w-11/12">
        <div class="grid grid-cols-12 gap-6 divide-y-4">
            @include('admin.settings.settings.academicsettings')
            @include('admin.settings.settings.staffsettings')
            @if (env('SCHOOLTALKZ') == false)
                @include('admin.settings.settings.feesandexpenses')
                @include('admin.settings.settings.leavesettings')
                @include('admin.settings.settings.examsettings')
                @include('admin.settings.settings.frontdesksettings')
            @endif
            @include('admin.settings.settings.onlineassessment')
            @include('admin.settings.settings.feedpostsettings')
            @include('admin.settings.settings.integrationsettings')
            @include('admin.settings.settings.broadcastsettings')
            @include('admin.settings.settings.schoolsettings')
            @include('admin.settings.settings.profilesettings')
            @include('admin.settings.settings.logsettings')
        </div>
    </div>
@endsection
