<div>
    <div class="col-span-12 mt-3">
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select wire:model="classmasterid" class="form-select w-full mt-5">
                    <option value="">Select Class </option>
                    @foreach ($classteacher->unique('classmaster_id') as $eachclassmaster)
                        <option value="{{ $eachclassmaster->classmaster->id }}">
                            {{ $eachclassmaster->classmaster->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select wire:model="sectionid" class="form-select w-full mt-5">
                    <option value="0">Select Section </option>
                    @if ($classmasterid)
                        @foreach ($classteacher as $eachsection)
                            <option value="{{ $eachsection->section->id }}">
                                {{ $eachsection->section->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <input type="date" wire:model="attendancedate" class="form-control mt-5" placeholder="MMM-YYY">
            </div>
        </div>
    </div>
    @if ($sectionid && $attendancedate)
        <div class="grid grid-cols-12 mt-10 gap-4">
            @if ($tab == 'attendance')
                @include('livewire.staff.class.classattendance')
            @elseif($tab == 'routine')
                @include('livewire.staff.class.classroutine')
            @elseif($tab == 'exams')
                @include('livewire.staff.class.classexams')
            @elseif($tab == 'studentprogress')
                @include('livewire.staff.class.classstudentprogress')
            @endif
        </div>
    @else
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
        <div class="mx-auto flex flex-row items-center">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Date</span></p>
                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view class details</p>
            </div>
            <div>
                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                        alt="ppl">
            </div>
        </div>
    </div>
    @endif
</div>
