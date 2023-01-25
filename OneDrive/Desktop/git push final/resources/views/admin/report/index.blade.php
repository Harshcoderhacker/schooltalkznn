@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Report</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Report'])
@endsection

@section('subcontent')
    <div class="w-full mx-auto sm:w-11/12">
        <div class="grid grid-cols-12 gap-6">
            @if (env('SCHOOLTALKZ') == false)
                <div class="col-span-12 mt-4 sm:col-span-6">
                    @include('admin.report.attendancereport.studentattendancereport.studentattendance')
                </div>
                <div class="col-span-12 mt-4 sm:col-span-6">
                    @include('admin..report.attendancereport.staffattendancereport.staffattendance')
                </div>
                <div class="col-span-12 mt-4">
                    @include('admin.report.accountsreport.feereport.feereport')
                </div>
                <div class="col-span-12 mt-4">
                    @include('admin.report.examreport.examreport')
                </div>
            @endif
            <div class="col-span-12 mt-4">
                @include('admin.report.leaderboardreport.leaderboardreport')
            </div>
            <div class="col-span-12 mt-4">
                @include('admin.report.emotioncapturereport.emotioncapturereport')
            </div>
        </div>
    </div>
@endsection
