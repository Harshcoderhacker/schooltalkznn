@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Feed</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'aparentfeedlatest',
        'name' => 'Feed',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Mypost'])
@endsection

@section('subcontent')
    <div>
        @include('parent.feed.helper.feedpostwizard', ['postcategory' => 'MYPOST'])
        @livewire('admin.feed.addfeedlivewire', [
        "postcategory" => "MYPOST",
        "platform" => "student"])
        {{-- Toaster --}}
        @include('helper.toaster.toasternotification')
    </div>
@endsection

@section('script')
    <script>
        $('#aparentfeedlatest').addClass("side-menu--active");
    </script>
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'null'])
    {{-- Feed Script --}}
    @include('helper.feed.feedcommonscript.commonscript')
@endsection
