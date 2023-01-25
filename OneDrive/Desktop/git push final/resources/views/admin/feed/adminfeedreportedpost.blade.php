@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Feed</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminfeedlatest',
        'name' => 'Feed',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Reported Post',
    ])
@endsection

@section('subcontent')
    <div>
        @include('admin.feed.helper.feedpostwizard', [
            'postcategory' => 'REPORTED POST',
        ])
        @livewire('admin.feed.addfeedlivewire', ["postcategory" => "REPORTED POST", "platform" => null])
        {{-- Toaster --}}
        @include('helper.toaster.toasternotification')
    </div>
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
    <script>
        $('#adminfeedlatest').addClass("side-menu--active");
    </script>
    {{-- Feed Script --}}
    @include('helper.feed.feedcommonscript.commonscript')
@endsection
