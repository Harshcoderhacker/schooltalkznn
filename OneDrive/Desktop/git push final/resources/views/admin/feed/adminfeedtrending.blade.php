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
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Trending'])
@endsection

@section('subcontent')
    <div>
        @include('admin.feed.helper.feedpostwizard', ['postcategory' => 'TRENDING'])
        @livewire('admin.feed.addfeedlivewire', ["postcategory" => "TRENDING", "platform" => null])
        {{-- Toaster --}}
        @include('helper.toaster.toasternotification')
    </div>
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
