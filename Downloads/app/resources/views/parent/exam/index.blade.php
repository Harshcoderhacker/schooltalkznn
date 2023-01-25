@extends('../layout/parent/' . $layout)

@section('subhead')
    <title>Edfish - Examination</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Examination',
    ])
@endsection

@section('subcontent')
    @livewire('aparent.exam.parentexamindexlivewire')
    {{-- <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-9/12 mx-auto">
            <a href="{{ route('parentexammark') }}" class="col-span-12 sm:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 h-32 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl mx-auto mt-7">
                                Mark Sheet
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-span-12 sm:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 h-32 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl mx-auto mt-7">
                                Progress Card
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('parentonliveonlineassesment') }}" class="col-span-12 sm:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 h-32 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl mx-auto mt-7">
                                Online Assesments
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-1 mt-11">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Exam Name
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Subjects
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Start Date
                            </div>
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                End Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Status
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Unit Exam
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Computer
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 12, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 17, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center text-theme-11">
                                Yet to Start
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-primary w-auto">View Schedule</button>
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Unit Exam
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English, Tamil, Computer
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 12, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 17, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center text-theme-11">
                                Yet to Start
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-primary w-auto">View Schedule</button>
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Unit Exam
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English, Tamil, Computer
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 12, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 17, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center text-theme-9">
                                Started
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-primary w-auto">View Schedule</button>
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Unit Exam
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English, Tamil, Computer
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 12, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Nov 17, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-center text-theme-6">
                                Completed
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium">
                                <button type="button" class="btn btn-primary w-auto">View Schedule</button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
                <select class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 mx-0">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
    <script>
        $('#parentexam').addClass("side-menu--active");
    </script>
@endsection
