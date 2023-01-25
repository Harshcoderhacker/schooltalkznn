@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Report</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminreport',
        'name' => 'Report',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Student Progress Report',
    ])
@endsection

@section('subcontent')
    @livewire('admin.report.examreport.studentprogressreportlivewire')
@endsection

@section('script')
    <script>
        $('#adminreport').addClass("side-menu--active");
    </script>
@endsection
