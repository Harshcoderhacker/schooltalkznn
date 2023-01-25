@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Feed</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Feed'])
@endsection

@section('subcontent')
    <div>
        @include('admin.feed.helper.feedpostwizard', ['postcategory' => "HASTAG"])
        @livewire('admin.feed.adminfeedhashtaglivewire')
    </div>
@endsection

@section('script')
    <script>
        $('#adminfeedlatest').addClass("side-menu--active");
    </script>
@endsection
