<div>
    {{-- <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">Student Info</h2>
    </div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                        src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('image/avatar/avatar.jpeg') }}">
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                        {{ $student->name }}</div>
                    <div class="text-slate-500">
                        Class {{ $student->classmaster?->name }} -
                        {{ $student->section?->name }}
                    </div>
                    <div class="text-slate-500">
                        {{ config('archive.gender')[$student->gender] }}
                    </div>
                </div>
            </div>
            <div
                class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                    <div class="truncate sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="phone" class="w-4 h-4 mr-2"></i>
                        {{ $student->phone_no }}
                    </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3">
                        <i data-feather="mail" class="w-4 h-4 mr-2"></i>{{ $student->email }}
                    </div>
                    <div class="truncate sm:whitespace-normal mt-3">
                        {{ $student->address }}
                    </div>
                </div>
            </div>
            <div
                class="mt-6 lg:mt-0 flex-1 flex items-center justify-center  border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                <div class="text-center rounded-md w-48 py-3">
                    <div class="text-slate-500">ACADEMIC YEAR</div>
                    <div class="font-medium text-primary text-xl">{{ $student->academicyear?->year }}</div>
                </div>
            </div>
        </div>
    
        <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
            <li id="profile-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center active" data-tw-target="#profile"
                    aria-controls="profile" aria-selected="true" role="tab" {{ $activestatus == 'profile' ? 'active' : '' }}>
                    Profile
                </a>
            </li>
            <li id="fees-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#fees" aria-controls="fees"
                    aria-selected="false" role="tab" {{ $activestatus == 'fees' ? 'active' : '' }}>
                    Fees
                </a>
            </li>
            <li id="attendance-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#attendance"
                    aria-controls="attendance" aria-selected="false" role="tab" {{ $activestatus == 'attendance' ? 'active' : '' }}>
                    Attendance
                </a>
            </li>
            <li id="marks-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center"  data-tw-target="#marks" aria-controls="marks"
                    aria-selected="false" role="tab" {{ $activestatus == 'marks' ? 'active' : '' }}>
                    Marks
                </a>
            </li>
            <li id="progress-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#progress"
                    aria-controls="settings" aria-selected="false" role="tab" {{ $activestatus == 'progress' ? 'active' : '' }}>
                    Progress
                </a>
            </li>
            <li id="documents-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#documents" wire:click="activetab('documents')"
                    aria-controls="documents" aria-selected="false" role="tab" {{ $activestatus == 'documents' ? 'active' : '' }}>
                    Documents
                </a>
            </li>
        </ul> --}}
    
    
        <div class="tab-content">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
    
                <div class="box w-full mx-auto">
                    <h1 class="px-5 mt-3 truncate sm:whitespace-normal font-medium text-lg"> Personal </h1>
                    <div class="grid grid-cols-12 intro-y gap-4">
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">First Name</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Admission Number</th>
                                    <td>{{ $student->addmission_number }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Date of Birth</th>
                                    <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</td>
                                     {{-- ->format('j F, Y') </td> --}}
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">EMIS Number</th>
                                    <td>{{ $student->emis_number }}</td>
                                </tr>
                                {{-- <tr class="intro-x">
                                    <th class="uppercase">Father Name</th>
                                    <td>{{ $student->aparent?->father_name }}</td>
                                </tr> --}}
                                <tr class="intro-x" class="sm:hidden">
                                    <th class="uppercase">EMIS Number</th>
                                    <td>{{ $student->emis_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">Last Name</th>
                                    <td>{{ $student->last_name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Roll Number</th>
                                    <td>{{ $student->roll_no }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Blood Group</th>
                                    <td>{{ $student->blood_group ? config('archive.blood_group')[$student->blood_group]:'' }}</td>
                                </tr>
                                {{-- <tr class="intro-x">
                                    <th class="uppercase">Mother name</th>
                                    <td>{{ $student->aparent?->mother_name }}</td>
                                </tr> --}}
                                <tr class="intro-x" class="sm:hidden">
                                    <th class="uppercase">Address</th>
                                    <td>{{ $student->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    
    
                <div class="box w-full mx-auto">
                    <h1 class="px-5 mt-3 truncate sm:whitespace-normal font-medium text-lg"> Parents </h1>
                    <div class="grid grid-cols-12 intro-y gap-4">
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">Primary Phone No.</th>
                                    <td>{{ $student->phone_no }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Primary Name</th>
                                    <td>{{ $student->aparent?->name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Mother Occupation</th>
                                    <td>{{ $student->aparent?->mother_occupation }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Father Name</th>
                                    <td>{{ $student->aparent?->father_name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Father Phone No</th>
                                    <td>{{ $student->aparent?->father_phoneno }}</td>
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
                                    <th class="uppercase">Primary Mail</th>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Mother Name</th>
                                    <td>{{ $student->aparent?->mother_name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Mother Phone No</th>
                                    <td>{{ $student->aparent?->mother_phoneno }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Father Occupation</th>
                                    <td>{{ $student->aparent?->father_name }}</td>
                                </tr>
                                <tr class="intro-x" class="sm:hidden">
                                    <th class="uppercase">Father Office Address</th>
                                    <td>{{ $student->father_office_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                </div>
    
    
                <div class="box w-full mx-auto">
                    <h1 class="px-5 mt-3 truncate sm:whitespace-normal font-medium text-lg"> Transport </h1>
                    <div class="grid grid-cols-12 intro-y gap-4">
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">Route No.</th>
                                    <td>{{ $student->route_no }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Fee Amount</th>
                                    <td>{{ $student->fee_amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">Bus No</th>
                                    <td>{{ $student->bus_no }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase">Route Address</th>
                                    <td>{{ $student->route_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                </div>
    
    
            </div>
            {{-- <div id="fees" class="tab-pane" role="tabpanel" aria-labelledby="fees-tab">
                @if($feeassignstudent)
                <div class="box intro-y col-span-6 sm:col-span-12 overflow-auto lg:overflow-visible p-2 mt-5">
                    <div class=" mt-5">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Fee
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Due Date
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                status
                                            </div>
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Amount
                                        </th>
                
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Paid
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Balance
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feeassignstudent as $eachfeeassignstudent)
                                        <tr class="intro-x">
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ $eachfeeassignstudent->feemaster->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($eachfeeassignstudent->feemaster->due_date)->format('d-m-Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($eachfeeassignstudent->due_amount == 0)
                                                    <span
                                                        class="bg-success text-white w-full rounded-full px-6 py-3 font-bold">Paid</span>
                                                @elseif ($eachfeeassignstudent->due_amount != 0 && $eachfeeassignstudent->is_lock)
                                                    <span
                                                        class="bg-warning text-white w-full rounded-full px-6 py-3 font-bold">Partially
                                                        Paid</span>
                                                @else
                                                    <span class="bg-danger text-white w-full rounded-full px-6 py-3 font-bold">Not
                                                        Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    Rs. {{ round($eachfeeassignstudent->actual_amount, 2) }}
                                                </span>
                                            </td>
                
                                            <td>
                                                <span class="text-sm font-medium text-center">
                                                    Rs. {{ round($eachfeeassignstudent->total_paid_amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium text-center">
                                                    Rs. {{ round($eachfeeassignstudent->due_amount, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                @include('helper.datatable.norecordfound')
                @endif
            </div> --}}
            {{-- <div id="attendance" class="tab-pane" role="tabpanel" aria-labelledby="attendance-tab">
                <div class="box p-2 mt-5">
                    
                </div>
            </div> --}}
            {{-- <div id="marks" class="tab-pane" role="tabpanel" aria-labelledby="marks-tab" >
                <div class="box p-2 mt-2">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 sm:col-span-3 intro-y">
                            <select wire:model="examid" class="form-select w-full mt-5">
                                <option value="0">Select Exam </option>
                                @foreach ($examlist as $eachexam)
                                    <option value="{{ $eachexam->id }}">
                                        {{ $eachexam->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-8 ml-10 justify-around gap-8">
                        @if ($selectedexam)
                            <div class="col-span-12 sm:col-span-12 border">
                                <div class="grid grid-cols-12 p-4">
                                    <div class="col-span-12 sm:col-span-12 p-4 flex flex-row justify-between">
                                        <div>
                                            <span class="font-semibold">Exam Name :
                                                {{ $selectedexam[0]->name }}</span>
                                        </div>
                                        <div>
                                            <span class="font-semibold">Academic Year :
                                                {{ $selectedexam[0]->academicyear->year }}</span>
                                        </div>
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-12 overflow-auto lg:overflow-visible">
                                        <table class="table table-report -mt-2">
                                            <thead>
                                                <tr class="intro-x">
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Subject
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Total Marks
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Mark Obtained
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Subject Grade
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Remarks
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selectedexam[0]->examsubject as $key => $eachexamsubject)
                                                    <tr class="intro-x">
                                                        <td>
                                                            <span class="text-sm font-medium whitespace-nowrap">
                                                                {{ $eachexamsubject->subject->name }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-sm font-medium whitespace-nowrap">
                                                                {{ $eachexamsubject->mark }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-sm font-medium whitespace-nowrap">
                                                                {{ $examsubjectmark[$key]->mark }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-sm font-medium text-center text-theme-11">
                                                                @if(sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_present',1))>0)
                                                                    @foreach ($grade as $eachgrade)
                                                                        @if ($eachgrade->percentage_from <= $examsubjectmark[$key]->subjectmark_percentage && $eachgrade->percentage_to > $examsubjectmark[$key]->subjectmark_percentage)
                                                                        {{ $eachgrade->name }}
                                                                        @elseif($examsubjectmark[$key]->subjectmark_percentage == 100 && $eachgrade->percentage_to == 100)
                                                                            {{ $eachgrade->name }}
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                A
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-sm font-medium text-center text-theme-9">
                                                                {{ $examsubjectmark[$key]?->remarks }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr class="intro-x">
                                                    <td>
                                                        <span class="text-sm font-medium whitespace-nowrap">
                                                            All Subjects
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-sm font-medium whitespace-nowrap">
                                                            {{ $selectedexam[0]->examsubject->sum('mark') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-sm font-medium whitespace-nowrap">
                                                            {{ $examsubjectmark->sum('mark') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-sm font-medium text-center text-theme-11">
                                                            @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                                                $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                                                @foreach ($grade as $eachgrade)
                                                                    @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100)
                                                                        {{ $eachgrade->name }}
                                                                    @elseif(($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                                                        {{ $eachgrade->name }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                F
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-sm font-medium whitespace-nowrap">
                                                            @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                                                $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                                                Pass
                                                            @else
                                                                Fail
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div
                                        class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                                        <div>
                                            <span class="text-green-500">Overall Percentage</span><br>
                                            <span class="text-xl">
                                                {{ round(($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100) }}
                                                %
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-green-500">Rank</span><br>
                                            @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                                                $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                                                {{ array_search($studentid, array_keys($total_mark)) + 1 }} /
                                                {{ sizeof($total_mark) }}
                                            @else
                                                <span class="text-xl">-</span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-green-500">Grade</span><br>
                                            @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                                                $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                                                @foreach ($grade as $eachgrade)
                                                    @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                                                        <span class="text-xl">{{ $eachgrade->name }}</span>
                                                    @elseif(($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                                        <span class="text-xl">{{ $eachgrade->name }}</span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-xl">F</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                                        @foreach ($grade as $eachgrade)
                                            <div>
                                                <span class="text-sm text-blue-600">
                                                    {{ $eachgrade->percentage_from }} % - {{ $eachgrade->percentage_to }} %
                                                    {{ $eachgrade->name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
            </div> --}}
            {{-- <div id="progress" class="tab-pane" role="tabpanel" aria-labelledby="progress-tab">
                <div class="box p-2 mt-5">
                    <div class="intro-y col-span-12 mt-8 overflow-auto lg:overflow-visible">
                        @if($exam)
                        <table class="table -mt-2">
                            <th>
                                Subject
                            </th>
                            <th>
                                Exam Name
                            </th>
                            <th>
                                Marks Obtained
                            </th>
                            <th>
                                Subject Grade
                            </th>
                            <th>
                                Remarks
                            </th>
                            @foreach ($exam->unique('subject_id') as $eachexam)
                                @foreach ($eachexam->examsubject as $eachsubject)
                                    <tr>
                                        <td>
                                            {{ $eachsubject->subject->name }}
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>{{ $eachexam->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            {{ $eachexam->overallmark($student->id, $eachsubject->subject_id) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            @foreach ($grade as $eachgrade)
                                                                @if ($eachgrade->percentage_from <= $eachexam->overallmark($student->id, $eachsubject->subject_id) && $eachgrade->percentage_to > $eachexam->overallmark($student->id, $eachsubject->subject_id))
                                                                    {{ $eachgrade->name }}
                                                                @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == 100 && $eachgrade->percentage_to == 100)
                                                                    {{ $eachgrade->name }}
                                                                @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == '-')
                                                                    -
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                @foreach ($exam as $eachexam)
                                                    <tr>
                                                        <td>
                                                            {{ $eachexam->remark($student->id, $eachsubject->subject_id) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                        @else
                        @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
            </div> --}}
            {{-- <div id="documents" class="tab-pane" role="tabpanel" aria-labelledby="documents-tab">
                <div class="box p-2 mt-5">
                    <div class="flex">
                        <table class="col-span-12 sm:col-span-6 w-full sm:w-6/12 table mt-3 rounded-lg">
                            <tbody class="divide-y-2">
                                <tr class="intro-x">
                                    <th class="uppercase">Aadhar Number</th>
                                    <td>{{ $student->adhaar_no }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="uppercase {{ $student->photo ? 'text-green-500' : '' }}">
                                        Photo</th>
                                    <td>
                                        @if($student->photo)
                                        <form method="POST" action="{{ route('studentdetailsdownload') }}">
                                            @csrf
                                            <input name="downloadpath" type="hidden" value="{{ $student->photo }}">
                                            <button type="submit">
                                                <img class="object-contain h-8 w-full" alt="download"
                                                    src="{{ asset('/image/settingsicon/downloadicon/file.png') }}">
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    {{ url('storage/' . $student->photo) }}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    
    
    
    {{-- </div> --}}
    <!-- END: Profile Info -->
</div>
