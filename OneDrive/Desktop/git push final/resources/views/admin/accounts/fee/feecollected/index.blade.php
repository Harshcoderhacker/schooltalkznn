@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminfee',
        'name' => 'Fee',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Fee Collected',
    ])
@endsection

@section('subcontent')
    @livewire('admin.accounts.feecollected.feecollectedindexlivewire')
@endsection

@section('script')
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
@endsection
