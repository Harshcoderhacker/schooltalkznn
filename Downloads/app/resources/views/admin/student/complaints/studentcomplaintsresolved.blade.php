@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Students</title>
@endsection

@section('breadcrumb')
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<a href="{{ route('adminstudent') }}" class="">Student</a>
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<p class="breadcrumb--active">Resolved Complaints</p>
@endsection


@section('subcontent')
<div class=" col-span-12 xl:col-span-12 ">
    <div class="p-2">
        <div class="grid grid-cols-12 gap-3 ">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="text-lg font-bold text-theme-1 mr-5">Complaints</h2>
            </div>
        </div>
    </div>
</div>
<div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
    @include('admin.student.complaints.helper.studentcomplaintsmenu', ['active' => 'resolved'])
</div>
<div class=" col-span-12 xl:col-span-12">
    <div class="p-2">
        <div class="grid grid-cols-12 gap-6 ">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 box p-10">
                <div class="mx-auto">
                    <div class="p-4 ">
                        @include('helper.datatable.norecordfound')
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5"><span
                            class="text-2xl">Oops!</span>
                        <br> No Record Found
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#adminstudent').addClass("side-menu--active");
</script>
@endsection