@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Fee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Fee'])
@endsection

@section('subcontent')
    @livewire('admin.accounts.feeindexlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'sectionid'])
@endsection
