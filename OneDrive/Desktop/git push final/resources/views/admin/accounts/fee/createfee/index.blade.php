@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Fee'])
@endsection

@section('subcontent')
    @livewire('admin.accounts.fee.createfeeindexlivewire')
@endsection

@section('script')
    <script>
        $('#adminfee').addClass("side-menu--active");
    </script>
@endsection
