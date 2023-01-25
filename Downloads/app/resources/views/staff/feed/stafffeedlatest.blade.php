@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Feed</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'stafffeedlatest',
        'name' => 'Feed',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Latest'])
@endsection

@section('subcontent')
    <div>
        @include('staff.feed.helper.feedpostwizard', ['postcategory' => 'LATEST'])
        @livewire('admin.feed.addfeedlivewire', [
        "postcategory" => "LATEST",
        "platform" => "staff"])
        {{-- Toaster --}}
        @include('helper.toaster.toasternotification')
    </div>
@endsection

@section('script')
    <script>
        $('#stafffeedlatest').addClass("side-menu--active");
    </script>
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
    {{-- Feed Script --}}
    @include('helper.feed.feedcommonscript.commonscript')
@endsection
