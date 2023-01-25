@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Fee'])
@endsection


@section('subcontent')
    @livewire('aparent.fee.aparentfeeindexlivewire')
@endsection

@section('script')
    <script>
        $('#parentfee').addClass("side-menu--active");
    </script>
@endsection
