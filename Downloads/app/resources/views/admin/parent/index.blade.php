@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Parent</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Parent'])
@endsection

@section('subcontent')
    @livewire('admin.parent.parentindexlivewire')
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'aparentid'])
    <script>
        $('#adminparent').addClass("side-menu--active");
    </script>
@endsection
