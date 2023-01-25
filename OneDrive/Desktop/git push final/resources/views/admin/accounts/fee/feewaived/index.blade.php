@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee Waived</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminfee',
        'name' => 'Fee',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Fee Waived',
    ])
@endsection

@section('subcontent')
    @livewire('admin.accounts.feewaived.feewaivedindexlivewire')
@endsection


@section('script')
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
@endsection
