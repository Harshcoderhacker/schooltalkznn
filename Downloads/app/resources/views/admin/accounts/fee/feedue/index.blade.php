@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee Due</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminfee',
        'name' => 'Fee',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Fee Due',
    ])
@endsection

@section('subcontent')
    @livewire('admin.accounts.feedue.feedueindexlivewire')
@endsection


@section('script')
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
@endsection
