<div>
    <div class="col-span-12">
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
            <a href="{{ route('parentprogresscard') }}" class="col-span-12 sm:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 h-32 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl mx-auto mt-7">
                                Progress Card
                            </div>
                        </div>
                    </div>
                </div>
            </a>
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
        @if ($exam)
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
                        @foreach ($exam as $eachexam)
                            <tr class="intro-x">
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $eachexam->name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        @foreach ($eachexam->examsubject as $key => $eachexamsubject)
                                            @if ($key == 0)
                                                {{ $eachexamsubject->subject->name }}
                                            @else
                                                , {{ $eachexamsubject->subject->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $eachexam->examsubject->min('examdate')->format('d-M-Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $eachexam->examsubject->max('examdate')->format('d-M-Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium text-center text-theme-11">
                                        Yet to Start
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium">
                                        <button type="button" class="btn btn-primary w-auto"
                                            wire:click="showexamschedule({{ $eachexam->id }})">View Schedule</button>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('helper.datatable.pagination', ['pagination' => $exam])
        @else
            @include('helper.datatable.norecordfound')
        @endif
    </div>
    @if ($showexamschedulemodal)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h2 class="font-bold text-lg text-white mr-auto">Exam Schedule</h2>
                            <button wire:click="examscheduleclosemodal"
                                class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-report -mt-2">
                                    <thead class="bg-primary">
                                        <tr class="intro-x">
                                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                                <div class="flex">
                                                    Exam Date
                                            </th>
                                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                                <div class="flex">
                                                    Subjects
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($examschedule as $eachexam)
                                            <tr class="intro-x">
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ $eachexam->examdate->format('d-M-Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ $eachexam->subject->name }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" wire:click="examscheduleclosemodal"
                                class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
