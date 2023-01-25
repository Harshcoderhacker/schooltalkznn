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
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Latest'])
@endsection

@section('subcontent')
    @include('admin.feed.helper.feedpostwizard', ['postcategory' => 'LATEST'])
    @livewire('admin.feed.addfeedlivewire', ["postcategory" => "LATEST", "platform" => null])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
    {{-- Feed Script --}}
    @include('helper.feed.feedcommonscript.commonscript')
    <script>
        $('#adminfeedlatest').addClass("side-menu--active");
    </script>
@endsection
