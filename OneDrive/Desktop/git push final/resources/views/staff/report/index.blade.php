@extends('../layout/staff/' . $layout)

@section('subhead')
<title>Edfish - Report</title>
@endsection

@section('breadcrumb')
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<p class="breadcrumb--active">Report</p>
@endsection

@section('subcontent')
@endsection

@section('script')
<script>
    $('#staffreport').addClass("side-menu--active");
</script>
@endsection