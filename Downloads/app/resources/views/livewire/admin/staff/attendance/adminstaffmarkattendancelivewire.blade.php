<div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-5">
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Staff Attendance for
            {{ $staffattendance->staffdesignation->name }} Department</h2>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">Date:
                {{ \Carbon\Carbon::parse($staffattendance->attendance_date)->format('F, d Y') }}</span>
        </div>
    </div>
    <div class="flex flex-col mt-3 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Roll ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Department
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Note
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Attendance
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffattendance->staffattendancelist as $eachstaffattendancelist)
                                <tr class="intro-x">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachstaffattendancelist->staff->staff_roll_id }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachstaffattendancelist->staff->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachstaffattendancelist->staff->staffdepartment->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" placeholder="Add Note"
                                            wire:model.debounce.500ms="note.{{ $eachstaffattendancelist->id }}"
                                            class="form-control border-0 border-b-2 w-full">
                                    </td>
                                    <td class="px-auto py-auto whitespace-nowrap w-auto">
                                        <div class="grid gap-4 grid-cols-12">
                                            <div class="col-span-3">
                                                <input
                                                    wire:click="markthistaffattendance({{ $eachstaffattendancelist->id }},'present')"
                                                    type="radio" class="w-4"
                                                    name="radio_{{ $eachstaffattendancelist->id }}"
                                                    id="present{{ $eachstaffattendancelist->id }}"
                                                    {{ $eachstaffattendancelist->present ? 'checked' : '' }}>
                                                <label for="present{{ $eachstaffattendancelist->id }}"
                                                    class="form-label mx-1">Present</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input
                                                    wire:click="markthistaffattendance({{ $eachstaffattendancelist->id }},'late')"
                                                    type="radio" class="w-4"
                                                    name="radio_{{ $eachstaffattendancelist->id }}"
                                                    id="late{{ $eachstaffattendancelist->id }}"
                                                    {{ $eachstaffattendancelist->late ? 'checked' : '' }}>
                                                <label for="late{{ $eachstaffattendancelist->id }}"
                                                    class="form-label mx-1">Late</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input
                                                    wire:click="markthistaffattendance({{ $eachstaffattendancelist->id }},'absent')"
                                                    type="radio" class="w-4"
                                                    name="radio_{{ $eachstaffattendancelist->id }}"
                                                    id="absent{{ $eachstaffattendancelist->id }}"
                                                    {{ $eachstaffattendancelist->absent ? 'checked' : '' }}>
                                                <label for="absent{{ $eachstaffattendancelist->id }}"
                                                    class="form-label mx-1">Absent</label>
                                            </div>
                                            <div class="col-span-3">
                                                <input
                                                    wire:click="markthistaffattendance({{ $eachstaffattendancelist->id }},'halfday')"
                                                    type="radio" class="w-4"
                                                    name="radio_{{ $eachstaffattendancelist->id }}"
                                                    id="halfday{{ $eachstaffattendancelist->id }}"
                                                    {{ $eachstaffattendancelist->halfday ? 'checked' : '' }}>
                                                <label for="halfday{{ $eachstaffattendancelist->id }}"
                                                    class="form-label mx-1">Half Day</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y">
        <a type="button" href="{{ route('staffattendanceindex') }}"
            class="float-right btn btn-primary rouded-full mt-5">Save</a>
    </div>
</div>
