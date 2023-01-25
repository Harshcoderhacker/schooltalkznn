@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Homework</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'parenthomework',
        'name' => 'Recent Homework',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Homework Summary',
    ])
@endsection


@section('subcontent')
    @livewire('aparent.homework.aparenthomeworksummarylivewire',['homeworkid' => $homeworkid])
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'homeworkid'])
    <script>
        $('#parenthomework').addClass("side-menu--active");
    </script>
@endsection
