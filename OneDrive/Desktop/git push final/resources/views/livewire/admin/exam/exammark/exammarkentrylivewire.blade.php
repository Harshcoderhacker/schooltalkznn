<div>
    <div class="col-span-12 mt-8">
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select wire:model="classmasterid" class="form-select w-full mt-5">
                    <option value="0">Select Class </option>
                    @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">
                            {{ $eachclassmaster->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select wire:model="sectionid" class="form-select w-full mt-5">
                    <option value="0">Select Section </option>
                    @foreach ($section as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Roll Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Subject Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Attendance Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Student Marks
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Total Marks
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                        Remarks
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentlist as $key => $eachstudentmarklist)
                                    <div>
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachstudentmarklist->examstudentlist->student->roll_no }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachstudentmarklist->examstudentlist->student->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachstudentmarklist->examstudentlist->student->addmission_number }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    @livewire('admin.exam.exammark.exammarkvalueentrylivewire',
                                                    ['examstudentsubjectlist' => $eachstudentmarklist, 'subject_id' =>
                                                    $subject_id],
                                                    key($eachstudentmarklist->id))
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $examsubject->mark }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" placeholder="Add Remark"
                                                    wire:model.debounce.500ms="remarks.{{ $eachstudentmarklist->id }}"
                                                    class="form-control border-0 border-b-2 w-full">
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
        <div class="flex flex-row mt-5 intro-y justify-end">
            <a href="{{ route('exammarkentry') }}" class="btn btn-danger">Cancel and Go Back</a>
            <a href="{{ route('exammarkentry') }}" class="btn btn-primary mx-4">Save</a>
        </div>
    </div>
