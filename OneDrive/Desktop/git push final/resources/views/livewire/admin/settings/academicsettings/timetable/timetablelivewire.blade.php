<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-3">
        @include(
            'admin.settings.academicsettings.helper.academicsettingsmenu',
            ['active' => 'timetable']
        )
        <div class="col-span-12">
            <div class="intro-y block sm:flex items-center h-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Search Class</h2>
            </div>
            <div class="mx-auto mt-2 sm:mt-5">
                <div class="w-full mx-auto sm:w-4/6">
                    <div class="grid grid-cols-12 gap-6 mt-2">
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <select wire:model="classmasterid" class="form-select w-full">
                                <option value="0">Select Class </option>
                                @foreach ($classmaster as $eachclassmaster)
                                    <option value="{{ $eachclassmaster->id }}">
                                        Class {{ $eachclassmaster->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <select wire:model="sectionid" class="form-select w-full">
                                <option value="0">Select Section </option>
                                @foreach ($section as $eachsection)
                                    <option value="{{ $eachsection->id }}">
                                        Section {{ $eachsection->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-2 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @if ($timetable && $sectionid !=0)
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider">
                                        Class Period
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Monday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Tuesday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Wednesday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Thursday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Friday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Saturday
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Sunday
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetable as $eachtimetable)
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachtimetable->classroutine->name }} <br>
                                                {{ $eachtimetable->classroutine->start_time->format('g:i A') }} -
                                                {{ $eachtimetable->classroutine->end_time->format('g:i A') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'monday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'tuesday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'wednesday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'thursday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'friday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'saturday']
                                            )
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @include(
                                                'livewire.admin.settings.academicsettings.timetable.timetablehelper',
                                                ['daystring' => 'sunday']
                                            )
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @elseif($classmasterid && ($sectionid || $sectionid ==0)&& $timetable->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class and Section</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to assign time table</p>
                            </div>
                            <div>
                                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character2.png') }}"
                                        alt="ppl">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($isModalOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h2 class="font-bold text-lg text-white mr-auto">Time Table</h2>
                            <button wire:click="timetableclosemodal"
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
                        <form wire:submit.prevent="updatetimetable">
                            <div class="modal-body grid grid-cols-12 gap-4">
                                @include('helper.show.show', [
                                    'label' => 'Day',
                                    'value' => ucfirst($day),
                                ])
                                @include('helper.show.show', [
                                    'label' => 'Period',
                                    'value' => $classroutineobj->name,
                                ])
                                @include('helper.show.show', [
                                    'label' => 'Start Time',
                                    'value' => $classroutineobj->start_time->format('g:i A'),
                                ])
                                @include('helper.show.show', [
                                    'label' => 'End Time',
                                    'value' => $classroutineobj->end_time->format('g:i A'),
                                ])
                                <div class="col-span-12 sm:col-span-12">

                                    <div class="p-0 space-y-6">
                                        <select wire:model.lazy="assignsubjectid" class="form-select w-1/2">
                                            <option>Select Subject</option>
                                            @foreach ($allassignsubject as $eachassignsubject)
                                                {{ $eachassignsubject }}
                                                <option value="{{ $eachassignsubject->id }}">
                                                    {{ $eachassignsubject->subject?->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('assignsubjectid')
                                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div
                                class="p-2 flex flex-row-reverse items-center gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button type="button" wire:click="timetableclosemodal"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
