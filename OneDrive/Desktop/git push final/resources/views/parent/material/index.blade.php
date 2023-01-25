@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Material</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Material'])
@endsection


@section('subcontent')
    <livewire:admin.material.materialindexlivewire :platform="$platform" />
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'materiallistid'])
    <script>
        $('#parentmaterial').addClass("side-menu--active");
    </script>
@endsection
