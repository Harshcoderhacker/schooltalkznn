<div class="mt-8">
    <p class="text-lg font-semibold">
        Staff Attendance Allocation
    </p>
    @include('livewire.staff.smartattendance.smartattendancemenu')
    @if ($dateinput)
        <div class="flex gap-2">
            <div class="flex flex-col">
                <input type="date" wire:model.lazy="selecteddate" class="form-control w-52" />
                @error('selecteddate')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="intro-x">
                <button wire:click="selecthisdate"
                    class="btn btn-primary py-2 px-3 w-full xl:w-32 xl:mr-3 align-top text-center"
                    wire:loading.attr="disabled">
                    <div wire:loading>
                        @include('helper.loadingicon.loadingicon')
                    </div>
                    <span wire:loading.remove>select</span>
                </button>
            </div>
        </div>
    @endif
    @if ($dateinput ? $stafflist : $staffattendance)
        <p class="mt-5">
            Staff Absentees -
            @if ($dateinput)
                {{ count($stafflist) > 1 ? count($stafflist) . ' Staffs Absent' : count($stafflist) . ' Staff Absent' }}
            @else
                {{ $staffattendance->absentstaff->count() > 1? $staffattendance->absentstaff->count() . ' Staffs Absent Today': $staffattendance->absentstaff->count() . ' Staff Absent Today' }}
            @endif
        </p>
    @else
        <p class="mt-5">
            No absentees
        </p>
    @endif
    @if ($dateinput ? ($stafflist ? count($stafflist) : 0) > 0 : $staffattendance?->absentstaff->count() > 0)
        <div class="grid grid-cols-12 gap-6 mt-5">
            @foreach ($dateinput ? $stafflist : $staffattendance->absentstaff as $eachstaff)
                <div
                    class="intro-x col-span-12 lg:col-span-6 flex flex-row w-full justify-between p-4 items-center text-sm border">
                    <div class="text-sm font-semibold px-3">
                        {{ $eachstaff->staff->name }} <br>
                        @php
                            $count = $eachstaff->staff
                                ->findtotalclass(strtolower($date->format('l')))
                                ->get()
                                ->count();
                        @endphp
                        <span
                            class="text-primary font-semibold">{{ $count > 1 ? $count . ' classes' : $count . ' class' }}
                        </span>
                    </div>
                    <div>
                        @php
                            $assigncount = $eachstaff->staff->assignsubjectcount($date->format('l'), $date);
                        @endphp
                        @if ($assigncount == $count)
                            <button wire:click="showmodal({{ $eachstaff->staff_id }})"
                                class="btn btn-success">Substitutes Assigned</button>
                        @elseif ($assigncount == 0)
                            <button wire:click="showmodal({{ $eachstaff->staff_id }})" class="btn btn-danger">No
                                Substitutes Assigned</button>
                        @else
                            <button wire:click="showmodal({{ $eachstaff->staff_id }})" class="btn btn-warning">
                                {{ $assigncount }} {{ $assigncount > 1 ? 'Substitutes' : 'Substitute' }} Assigned
                                <br>{{ $count - $assigncount }} pending</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @include('helper.datatable.norecordfound')
    @endif
    @if ($showmodal)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="closemodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div class="flex justify-between items-center p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ $staff->gender == 1 ? 'Mr. ' : 'Mrs. ' }} {{ $staff->name }}
                        </h3>
                        <button type="button" wire:click="closemodal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="text-md font-normal">
                            {{ $this->date->format('F d, Y') }}
                        </p>
                        @foreach ($classroutine as $eachclassroutine)
                            @php
                                $assingsubject = !$eachclassroutine->stafftimetable->isEmpty() ? $eachclassroutine->stafftimetable[0]->findclassinfo(strtolower($date->format('l'))) : null;
                            @endphp
                            @if ($assingsubject)
                                <div class="mt-5">
                                    <div class="font-semibold mt-5">
                                        {{ 'Class ' . $assingsubject->classmaster->name . ' ' . $assingsubject->section->name }}
                                        -
                                        {{ $eachclassroutine->name }}
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 mt-5">
                                        <div
                                            class="flex flex-row col-span-3 w-full mt-3 justify-between p-4 items-center text-sm border">
                                            <div class="text-sm font-semibold">
                                                {{ $assingsubject->subject->name }}
                                            </div>
                                            <div class="text-sm font-semibold text-warning flex gap-1 justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $eachclassroutine->start_time->format('g:ia') . ' - ' . $eachclassroutine->end_time->format('g:ia') }}
                                            </div>
                                            <div class="text-sm font-normal">
                                                @php
                                                    $staffname = $eachclassroutine->substituteteacher($this->staff->id, $date);
                                                @endphp
                                                @if ($staffname)
                                                    <span>assinged to <span
                                                            class="font-semibold">{{ $staffname }}</span></span>
                                                    <button
                                                        wire:click="openavailableteachers({{ $eachclassroutine->id }},'{{ strtolower($date->format('l')) }}')"
                                                        class="font-semibold text-success hover:underline">Change</button>
                                                @else
                                                    <button
                                                        wire:click="openavailableteachers({{ $eachclassroutine->id }},'{{ strtolower($date->format('l')) }}')"
                                                        class="font-semibold text-danger hover:underline">Assign
                                                        Now</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($showavailableteachers)
        <div class="right-0 left-0 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex"
            style="z-index:55;">
            <div type="button" wire:click="closeavailableteachers" class="absolute inset-0 bg-gray-500 opacity-75">
            </div>
            <div class="relative lg:w-1/2 w-full">
                <div class="bg-white rounded item-center h-modal md:h-auto shadow dark:bg-gray-700">
                    <div class="flex justify-center p-4 rounded-t border-b dark:border-gray-600 bg-primary">
                        <h3 class="text-lg font-medium text-white text-center">
                            Teachers Avaliable at {{ $availabletime }}
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="overflow-y-auto" style="height: 16rem;">
                            @foreach ($availableteachers as $eachavailableteacher)
                                @php
                                    $selected = $eachavailableteacher->staff->findselected(strtolower($date->format('l')), $date, $eachavailableteacher->classroutine_id, $staff->id);
                                @endphp
                                <div
                                    class="flex flex-row w-full mt-3 justify-between p-4 items-center text-sm border {{ $selected ? 'bg-primary text-white' : '' }}">
                                    <div class="text-sm font-semibold">
                                        {{ $eachavailableteacher->staff->gender == 1 ? 'Mr. ' : 'Mrs. ' }}
                                        {{ $eachavailableteacher->staff->name }}
                                    </div>
                                    <div class="text-sm font-semibold">
                                        {{ $eachavailableteacher->staff->staffdepartment->name }} Department
                                    </div>
                                    @if (!$selected)
                                        <div class="text-sm font-normal">
                                            <button
                                                wire:click="selectteacher({{ $eachavailableteacher->staff->id }},{{ $eachavailableteacher->classroutine_id }} )"
                                                class="font-semibold text-primary hover:underline">Select</button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
