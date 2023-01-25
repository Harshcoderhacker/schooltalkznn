@extends('../layout/staff/' . $layout)

@section('subhead')
<title>Edfish - Students</title>
@endsection

@section('breadcrumb')
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<a href="{{ route('staffstudentindex') }}" class="">Student</a>
<i data-feather="chevron-right" class="breadcrumb__icon"></i>
<p class="breadcrumb--active">Student Show</p>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-5">
    <h2 class="text-lg font-medium mr-auto">Student Info</h2>
</div>
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="grid grid-cols-12 lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
        <div class="flex flex-1 col-span-12 sm:col-span-4 px-5 items-center justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                    src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
                <div
                    class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                    <i class="w-4 h-4 text-white" data-feather="camera"></i>
                </div>
            </div>
            <div class="ml-5">
                <div class="w-auto font-medium text-lg text-theme-1">Mukhilan Elangovan</div>
                <div class="w-auto font-medium text-base">Class 7 - C</div>
                <div class="text-gray-600">Male</div>
            </div>
        </div>
        <div
            class="mt-6 lg:mt-0 flex-1 col-span-12 sm:col-span-8 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="font-semibold text-center lg:text-left lg:mt-3 text-xl">Contact Details</div>
            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="w-auto flex items-center">
                    <i data-feather="phone" class="w-4 h-4 mr-2"></i>+91 73959 44078
                </div>
                <div class="w-auto flex items-center mt-3">
                    <i data-feather="mail" class="w-4 h-4 mr-2"></i> mukhilan.8queens@gmail.com
                </div>
                <div class="w-auto flex items-center mt-3">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i> Ekkathuthangal, Chennai - 600 032
                </div>
            </div>
        </div>
    </div>
    <div class="nav nav-tabs flex-col sm:flex-row justify-center sm:justify-start" role="tablist">
        <a id="dashboard-tab" data-toggle="tab" data-target="#dashboard" href="javascript:;" class="py-4 sm:mr-8 active"
            role="tab" aria-controls="dashboard" aria-selected="true">Profile</a>
        <a id="account-and-profile-tab" data-toggle="tab" data-target="#account-and-profile" href="javascript:;"
            class="py-4 sm:mr-8" role="tab" aria-selected="false">Fees</a>
        <a id="activities-tab" data-toggle="tab" data-target="#activities" href="javascript:;" class="py-4 sm:mr-8"
            role="tab" aria-selected="false">Attendance</a>
        <a id="tasks-tab" data-toggle="tab" data-target="#tasks" href="javascript:;" class="py-4 sm:mr-8" role="tab"
            aria-selected="false">Marks</a>
        <a id="tasks-tab" data-toggle="tab" data-target="#tasks" href="javascript:;" class="py-4 sm:mr-8" role="tab"
            aria-selected="false">Progress</a>
        <a id="tasks-tab" data-toggle="tab" data-target="#tasks" href="javascript:;" class="py-4 sm:mr-8" role="tab"
            aria-selected="false">Documents</a>
    </div>
</div>
<div class="box grid grid-cols-12 intro-y mt-8 gap-4 w-full sm:w-11/12 mx-auto">
    <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
        <tbody class="divide-y-2">
            <tr class="intro-x">
                <th class="uppercase">Admission Number</th>
                <td>125</td>
            </tr>
            <tr class="intro-x">
                <th class="uppercase">Date of Birth</th>
                <td>November 23, 1999</td>
            </tr>
            <tr class="intro-x">
                <th>EMIS Number</th>
                <td>123456</td>
            </tr>
            <tr class="intro-x">
                <th class="uppercase">Father Name</th>
                <td>Elangovan</td>
            </tr>
            <tr class="intro-x" class="sm:hidden">
                <th class="uppercase"></th>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
        <tbody class="divide-y-2">
            <tr class="intro-x">
                <th class="uppercase">Roll Number</th>
                <td>Mukhilan E</td>
            </tr>
            <tr class="intro-x">
                <th class="uppercase">Blood Group</th>
                <td>B+</td>
            </tr>
            <tr class="intro-x">
                <th class="uppercase">Skills</th>
                <td>Swimming</td>
            </tr>
            <tr class="intro-x">
                <th class="uppercase">Mother name</th>
                <td>Ananthi</td>
            </tr>
            <tr class="intro-x" class="sm:hidden">
                <th class="uppercase"></th>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    $('#staffstudentindex').addClass("side-menu--active");
</script>
@endsection