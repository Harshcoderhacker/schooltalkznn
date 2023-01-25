@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Homework</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Homework'])
@endsection

@section('subcontent')
    @livewire('admin.homework.homeworkindexlivewire', ["platform" => "staff"])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    <script>
        $('#staffhomework').addClass("side-menu--active");
    </script>
@endsection
