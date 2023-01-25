@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Homework</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminhomework',
        'name' => 'Homework',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Homework Summary',
    ])
@endsection

@section('subcontent')
    <div>
        <div class="intro-y grid grid-cols-12 gap-5 mt-5">
            @livewire('admin.homework.homeworksummarylivewire', ["platform" => "admin",'homework' => $homeworkuuid])
            @livewire('admin.homework.homeworklistlivewire', ["platform" => "admin",'homework' => $homeworkuuid])
        </div>
    </div>
    {{-- Toaster --}}
    @include('helper.toaster.toasternotification')
@endsection

@section('script')
    {{-- Toaster Script --}}
    @include('helper.toaster.toasterscript', ['deleteid' => 'homeworkid'])
    <script>
        $('#adminhomework').addClass("side-menu--active");
    </script>
@endsection
