<div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Fee Due</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
            <div class="col-span-12 sm:col-span-3 intro-y">
                <select wire:model="feemasterid" class="form-select w-full mt-5">
                    <option value="0">Select Fee </option>
                    @foreach ($feemaster as $eachfeemaster)
                        <option value="{{ $eachfeemaster->id }}">
                            {{ $eachfeemaster->name }}
                        </option>
                    @endforeach
                </select>
            </div>
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
            <div class="intro-y col-span-12 sm:col-span-3 flex flex-wrap sm:flex-nowrap items-center mt-5 w-full">
                <div class="mt-3 sm:mt-0">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input wire:model="searchTerm" type="text" class="form-control pr-10 placeholder-theme-13"
                            placeholder="Search...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($studentfeeduelist->isNotEmpty())
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        <div class="flex">
                                            Student Name
                                            @include('helper.datatable.sorting', [
                                                'method' => 'sortBy',
                                                'value' => 'name',
                                            ])
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Roll Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Amount (Rs)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Balance (Rs)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                        Collect Fee
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentfeeduelist as $eachstudentfeeduelist)
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentfeeduelist->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstudentfeeduelist->roll_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                Rs.
                                                {{ round($eachstudentfeeduelist->feeduestudent->sum('actual_amount'), 2) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex mx-auto text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                Rs.
                                                {{ round($eachstudentfeeduelist->feeduestudent->sum('due_amount'), 2) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap text-center">
                                            <a href="{{ route('feestudentinfo', $eachstudentfeeduelist->id) }}"
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                                style="color:rgb(0, 221, 0)">
                                                View Data
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('helper.datatable.pagination', [
            'pagination' => $studentfeeduelist,
        ])
    @else
        @include('helper.datatable.norecordfound')
    @endif
</div>
