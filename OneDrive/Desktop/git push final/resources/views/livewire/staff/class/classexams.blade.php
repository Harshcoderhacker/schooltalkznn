@include('staff.class.helper.staffclasssidemenuhelper', [
    'active' => 'exams',
])
<div class="col-span-12 lg:col-span-10 box w-full lg:w-11/12 p-10 intro-y">
    <div class="grid grid-cols-12 gap-4">
        <div class=" col-span-12 lg:col-span-8 grid grid-row gap-4">
            @foreach ($exam as $eachexam)
                @if($eachexam->examsubject->min('examdate')->format('Y-m-d') <= Carbon\Carbon::today()->format('Y-m-d') && 
                $eachexam->examsubject->min('examdate')->format('Y-m-d') >=  Carbon\Carbon::today()->format('Y-m-d'))
                <div class="col-span-12 lg:col-span-8 p-2 rounded-lg" style="background-color: #44BD32">
                @elseif($eachexam->examsubject->min('examdate')->format('Y-m-d') > Carbon\Carbon::today()->format('Y-m-d'))
                <div class="col-span-12 lg:col-span-8 p-2 rounded-lg" style="background-color: orange">
                @else
                <div class="col-span-12 lg:col-span-8 p-2 rounded-lg" style="background-color: rgb(248 113 113)">
                @endif 
                    <div class="grid grid-cols-12 mt-5">
                        <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-white">
                        {{$eachexam->name}}
                        </div>
                        <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-white">
                            Number of Subjects: {{$eachexam->examsubject->count()}}
                        </div>
                        <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-white">
                            Marks: {{$eachexam->examsubject->sum('mark')}}
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-5 gap-2">
                        <div class="col-span-12 lg:col-span-6 mx-auto font-semibold text-base flex gap-1 mt-2">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                            @if($eachexam->examsubject->count()>1)
                            <span class="text-sm text-white">{{ $eachexam->examsubject->min('examdate')->format('d-M') }} - {{ $eachexam->examsubject->max('examdate')->format('d-M') }}</span>
                            @else
                            <span class="text-sm text-white">{{ $eachexam->examsubject[0]->examdate->format('d-M-Y')}}</span>
                            @endif
                        </div>
                        <div class="col-span-12 lg:col-span-6 font-semibold text-base text-white text-center">
                            <button class="btn btn-warning" wire:click="viewschedule('{{$eachexam->id}}')">View Schedule</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@if ($examschedule)
<div class="fixed inset-0  z-50 transition-opacity">
    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
</div>
<div
    class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
    <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-8/12 shadow-2xl">
        <div
            class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
            <h3 class="text-lg font-semibold text-white">
                Exam Schedule
            </h3>
            <button wire:click="closeviewschedule"
                class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="defaultModal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-6">
            <div class=" col-span-12 xl:col-span-8 ">
                <div class="grid grid-cols-12 gap-1">
                    @if ($examschedule->isNotEmpty())
                    <div class="modal-header text-white font-semibold">
                        <h2 class="font-medium text-base mx-auto">{{$examschedule[0]->exam->name}}</h2>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <p class="font-semibold text-base">Class: {{$classmaster}} - {{$section}}</p>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <p class="font-semibold text-base">Status: <span class="text-theme-6">
                        @if($examschedule->min('examdate')->format('Y-m-d') <= Carbon\Carbon::today()->format('Y-m-d') && 
                            $examschedule->min('examdate')->format('Y-m-d') >=  Carbon\Carbon::today()->format('Y-m-d'))
                        On Going
                        @elseif($examschedule->min('examdate')->format('Y-m-d') > Carbon\Carbon::today()->format('Y-m-d'))
                        Not Started
                        @else
                        Ended
                        @endif 
                        </span></p>
                    </div>
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap text-lg">Subject Name</th>
                                        <th class="whitespace-nowrap text-lg">Date</th>
                                        <th class="whitespace-nowrap text-lg">Start Time</th>
                                        <th class="whitespace-nowrap text-lg">End Time</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examschedule as $key => $value)
                                        <tr class="intro-x">
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $value->subject->name }}
                                            </td>
                                            <td class="font-medium whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($value->examdate)->format('d, M Y') }}
                                            </td>
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $value->start->format('h:i a') }}
                                            </td>
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $value->end->format('h:i a') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</div>
