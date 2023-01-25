<div>
    <div class="intro-y flex items-center h-10 mt-3">
        <h2 class="text-lg font-medium truncate mr-5">View Mark of Exam Name : {{ $examsubject->exam->name }} </h2>
    </div>
    <div class="intro-y flex items-center h-10 mt-3">
        <h3 class="text-lg font-medium truncate mr-5">Subject : {{ $examsubject->subject->name }} </h3>
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
                                    S.NO
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Roll Number
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Student Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Class
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Section
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Mark
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Mark Obtained
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
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
                                                {{ $key + 1 }}
                                            </span>
                                        </td>
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
                                                {{ $eachstudentmarklist->examstudentlist->classmaster->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentmarklist->examstudentlist->section->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $examsubject->mark }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentmarklist->mark }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentmarklist->remarks }}
                                            </span>
                                        </td>
                                    </tr>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('helper.datatable.pagination', ['pagination' => $studentlist])
    </div>
</div>
