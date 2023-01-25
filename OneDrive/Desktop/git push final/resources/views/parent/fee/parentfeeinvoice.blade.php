@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'parentfee',
        'name' => 'Fee',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Invoice',
    ])
@endsection


@section('subcontent')
    @livewire('aparent.fee.aparentfeeinvoicelivewire')
@endsection

@section('script')
    <script>
        $('#parentfee').addClass("side-menu--active");
    </script>
@endsection
