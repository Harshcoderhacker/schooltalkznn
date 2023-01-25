<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4">
    @include('admin.exam.assessment.helper.createassessmentformwizard', ['active' => 'managequestion'])
    <div class="mx-auto w-full sm:w-5/6 mt-8">
        <div class="mx-auto w-full sm:w-5/6 flex flex-wrap sm:flex-nowrap items-center">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mr-5">Manage Questions</h2>
            <div class="w-full sm:w-auto sm:mt-0 sm:ml-auto md:float-right">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input wire:model="searchTerm" type="text" class="form-control w-56 box pr-10 placeholder-theme-13"
                        placeholder="Search...">
                    {{-- @include('helper.datatable.search') --}}
                </div>
            </div>
        </div>
        <div class="mt-3 px-5 sm:px-20 border-t border-gray-200 dark:border-dark-5 border-none">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th scope="col"
                            class="text-center px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Select
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Question
                        </th>
                        <th scope="col"
                            class="text-center px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Marks
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                Maria ____ never late to work
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                5
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                When I graduate from college next June, I _____
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                10
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                Eli's hobbies include jogging, swimming, and _______
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                15
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                Juan _______ in the library this morning.
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                10
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                Who is ________, Marina or Sachiko?
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                15
                            </span>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <input type="checkbox" class="w-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                Mr.Hawkins requests that someone ______ the data
                            </span>
                        </td>
                        <td class="text-center px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                20
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                <a href="{{ route('assessmentexamschedule') }}" class="btn btn-secondary w-24">Pervious</a>
                <a href="{{ route('assessmentexamconfiguration') }}" class="btn btn-primary w-24 ml-2">Next</a>
            </div>
        </div>
    </div>
</div>