<div>
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Roll No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Student Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Admission Number
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
                            @foreach ($studentlist as $key => $eachstudentattendancelist)
                                <div>
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentattendancelist->examstudentlist->student->roll_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentattendancelist->examstudentlist->student->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentattendancelist->examstudentlist->student->addmission_number }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" placeholder="Add Note"
                                                wire:model.debounce.500ms="note.{{ $eachstudentattendancelist->id }}"
                                                class="form-control border-0 border-b-2 w-full">
                                        </td>
                                        <td class="px-auto py-auto whitespace-nowrap w-auto">
                                            <div class="grid gap-4 grid-cols-12">
                                                <div class="col-span-3">
                                                    <input
                                                        wire:click="markthistudentattendance({{ $eachstudentattendancelist->id }},1)"
                                                        type="radio" class="w-4"
                                                        name="radio_{{ $eachstudentattendancelist->id }}"
                                                        id="present{{ $eachstudentattendancelist->id }}"
                                                        {{ $eachstudentattendancelist->is_present == true ? 'checked' : '' }}>
                                                    <label for="present{{ $eachstudentattendancelist->id }}"
                                                        class="form-label mx-1">Present</label>
                                                </div>
                                                <div class="col-span-3">
                                                    <input
                                                        wire:click="markthistudentattendance({{ $eachstudentattendancelist->id }},0)"
                                                        type="radio" class="w-4"
                                                        name="radio_{{ $eachstudentattendancelist->id }}"
                                                        id="absent{{ $eachstudentattendancelist->id }}"
                                                        {{ !$eachstudentattendancelist->is_present ? 'checked' : '' }}>
                                                    <label for="absent{{ $eachstudentattendancelist->id }}"
                                                        class="form-label mx-1">Absent</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y">
        <a type="button" href="{{ route('staffexamattendance') }}"
            class="float-right btn btn-primary rouded-full mt-5">Save</a>
    </div>
</div>
