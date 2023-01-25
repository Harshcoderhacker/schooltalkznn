<div>
    <div class="intro-y flex items-center h-10 mt-3">
        <h2 class="text-lg font-medium truncate mr-5">Search Exam </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <select wire:model="classmaster_id" class="form-select w-full mt-5">
                <option value="0">Select Class </option>
                @foreach ($classmaster as $eachclassmaster)
                    <option value="{{ $eachclassmaster->id }}">
                        {{ $eachclassmaster->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <select wire:model="section_id" class="form-select w-full mt-5">
                <option value="0">Select Section </option>
                @foreach ($section as $eachsection)
                    <option value="{{ $eachsection->id }}">
                        {{ $eachsection->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <select wire:model="exam_id" class="form-select w-full mt-5">
                <option value="0">Select Exam </option>
                @foreach ($exam as $eachexam)
                    <option value="{{ $eachexam->id }}">
                        {{ $eachexam->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @if (count($examlist) > 0)
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Attendance Percentage
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Marked By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Mark Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examlist as $index => $eachexam)
                                    @foreach ($eachexam->examsubject as $eachsubject)
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachsubject->subject->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachsubject->examdate->format('d-M-Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ round($eachsubject->attendance_percentage) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    @if ($eachsubject->mark_usertype)
                                                        @if ($eachsubject->mark_usertype == 'ADMIN')
                                                            {{ App\Models\Admin\Auth\User::find($eachsubject->mark_marked_id)->name }}
                                                        @else
                                                            {{ App\Models\Staff\Auth\Staff::find($eachsubject->mark_marked_id)->name }}
                                                        @endif
                                                    @else
                                                        Not Taken Yet
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full {{ $eachsubject->mark_status ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $eachsubject->mark_status ? 'Marked' : 'Unmarked' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if ($eachsubject->mark_status)
                                                    <a href="{{ route('adminviewmark', ['examid' => $eachsubject->exam_id, 'subjectid' => $eachsubject->subject_id]) }}"
                                                        type="button"
                                                        class="btn btn-outline-warning zoom-in inline-block mr-1 mb-2">View
                                                        Marks</a>
                                                @else
                                                    <button
                                                        class="btn btn-outline-warning zoom-in inline-block mr-1 mb-2 tooltip"
                                                        title="Mark Not Entered">View
                                                        Marks</button>
                                                @endif
                                                @if ($eachsubject->mark_status)
                                                    <a href="{{ route('admindomarkentry', ['examid' => $eachsubject->exam_id, 'subjectid' => $eachsubject->subject_id]) }}"
                                                        type="button"
                                                        class="btn btn-outline-danger zoom-in inline-block mr-1 mb-2">Retake
                                                        Mark Entry</a>
                                                @else
                                                    @if (!$eachsubject->attendance_status)
                                                        <button
                                                            class="btn btn-outline-success zoom-in inline-block mr-1 mb-2 tooltip"
                                                            title="Take Attendance first">Take
                                                            Mark Entry</button>
                                                    @else
                                                        <a href="{{ route('admindomarkentry', ['examid' => $eachsubject->exam_id, 'subjectid' => $eachsubject->subject_id]) }}"
                                                            type="button"
                                                            class="btn btn-outline-success zoom-in inline-block mr-1 mb-2">Take
                                                            Mark Entry</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif($classmaster_id && $section_id && $exam_id)
        @include('helper.datatable.norecordfound')
        @else
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
            <div class="mx-auto flex flex-row items-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Exam</span></p>
                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view Exams List</p>
                </div>
                <div>
                    <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                            alt="ppl">
                </div>
            </div>
        </div>
    @endif
</div>
