@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Homework</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Homework'])
@endsection

@section('subcontent')
    @livewire('admin.homework.homeworkindexlivewire', ["platform" => "admin"])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'homeworkid'])
@endsection
