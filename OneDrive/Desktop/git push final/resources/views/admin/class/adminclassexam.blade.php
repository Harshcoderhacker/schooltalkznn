@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminclass',
        'name' => 'Class',
    ])
    @include('helper.breadcrumb.breadcrumb', ['flag' => 'active', 'name' => 'Exam'])
@endsection

@section('subcontent')
    <div class="col-span-12 mt-3">
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option value="1">Class 10th</option>
                    <option value="2">Class 9th</option>
                    <option value="3">Class 8th</option>
                    <option value="4">Class 7th</option>
                    <option value="5">Class 6th</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option value="1">Section A</option>
                    <option value="2">Section A</option>
                    <option value="3">Section A</option>
                    <option value="4">Section A</option>
                    <option value="5">Section A</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option>Today</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <button type="button" class="btn btn-primary rounded-lg w-full ">Search</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 mt-10">
        @include('admin.class.helper.adminclasssidemenuhelper', [
            'active' => 'exams',
        ])
        <div class="col-span-12 sm:col-span-10 box w-full sm:w-11/12 p-10 intro-y">
            <div class="grid grid-cols-12 gap-4">
                <div class=" col-span-12 sm:col-span-9 grid grid-row gap-4">
                    <div class="col-span-12 sm:col-span-9 p-2 rounded-lg" style="background-color: #44BD32">
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Tamil Unit Exam
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Number of Subjects: 5
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Marks: 500
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-6 mx-auto font-semibold text-base flex gap-1 mt-2">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                                <span class="text-sm">October 12 - October 16</span>
                            </div>
                            <div class="col-span-12 sm:col-span-6 font-semibold text-base text-primary-3">
                                <a data-tw-toggle="modal" data-tw-target="#superlarge-modal-size-preview"
                                    class="btn btn-warning">View Schedule</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-9 p-2 rounded-lg" style="background-color: #F39C12">
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Tamil Unit Exam
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Number of Subjects: 5
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Marks: 500
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-6 mx-auto font-semibold text-base flex gap-1 mt-2">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                                <span class="text-sm">October 12 - October 16</span>
                            </div>
                            <div class="col-span-12 sm:col-span-6 sm:mt-0 font-semibold text-base text-primary-3">
                                <button class="btn btn-primary">View Schedule</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-9 p-2 rounded-lg" style="background-color: #F39C12">
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Tamil Unit Exam
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Number of Subjects: 5
                            </div>
                            <div class="col-span-12 sm:col-span-4 text-center font-semibold text-base text-white">
                                Marks: 500
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-5">
                            <div class="col-span-12 sm:col-span-6 mx-auto font-semibold text-base flex gap-1 mt-2">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                                <span class="text-sm">October 12 - October 16</span>
                            </div>
                            <div class="col-span-12 sm:col-span-6 sm:mt-0 font-semibold text-base text-primary-3">
                                <button class="btn btn-primary">View Schedule</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="superlarge-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white font-semibold">
                    <h2 class="font-medium text-base mx-auto">Tamil Unit Exam Schedule</h2>
                    <button data-dismiss="modal">
                        <i data-feather="x-circle" class="w-6 h-6 mr-2"></i>
                    </button>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-4">
                        <p class="font-semibold text-base">Class: V - A</p>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <p class="font-semibold text-base">Status: <span class="text-theme-6">Not
                                Started</span></p>
                    </div>
                    <div class="col-span-12 sm:col-span-12 box intro-y">
                        <div class="intro-y col-span-12 overflow-auto">
                            <table class="table table-report -mt-2 table-auto">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Subject Name
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Date
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Start Time
                                            </div>
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                End Time
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Class Room
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Invigilator
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="intro-x">
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                English
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                July 28, 2021
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                10 AM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                12.30 PM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                A Block, 12
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                -
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                Tamil
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                July 28, 2021
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                10 AM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                12.30 PM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                A Block, 12
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                -
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                Maths
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                July 28, 2021
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                10 AM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                12.30 PM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                A Block, 12
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                -
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                Science
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                July 28, 2021
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                10 AM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                12.30 PM
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                A Block, 12
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm font-medium whitespace-nowrap">
                                                -
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#adminclass').addClass("side-menu--active");
    </script>
@endsection
