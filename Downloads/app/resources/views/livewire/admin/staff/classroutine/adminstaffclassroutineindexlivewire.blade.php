<div>
    <div class="col-span-12 mt-5">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Teacher</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-8/12 mx-auto">
            <div class="col-span-12 sm:col-span-6 intro-y">
                <select wire:model="designationid" class="form-select w-full mt-5">
                    <option value="0">Select Department</option>
                    @foreach ($designation as $eachdesignation)
                        <option value="{{ $eachdesignation->id }}">
                            {{ $eachdesignation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 intro-y">
                <select wire:model="staff_id" class="form-select w-full mt-5">
                    <option value="">Select Staff</option>
                    @foreach ($stafflist as $eachstaff)
                        <option value="{{ $eachstaff->id }}">
                            {{ $eachstaff->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @if ($selectedstaff)
        @livewire('staff.classroutine.classroutinestafflivewire',['staff_id' => $selectedstaff],
        key($selectedstaff))
    @elseif($designationid && $staff_id && $staff_id ==0)
        @include('helper.datatable.norecordfound')
    @else
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
        <div class="mx-auto flex flex-row items-center">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Department and Staff</span></p>
                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view class routine</p>
            </div>
            <div>
                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                        alt="ppl">
            </div>
        </div>
    </div>
    @endif
</div>
