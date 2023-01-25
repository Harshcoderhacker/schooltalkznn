<div>
    <div class="w-full mx-auto sm:w-11/12">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Fee Due Report</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 gap-6 mt-2">
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
                @if (!empty($studentduelist))
                    <div
                        class="intro-y col-span-12 sm:col-span-2 flex flex-wrap sm:flex-nowrap items-center mt-5 w-full">
                        <div class="mt-3 sm:mt-0">
                            <div class="relative text-gray-700 dark:text-gray-300">
                                <input wire:model="searchTerm" type="text"
                                    class="form-control pr-10 placeholder-theme-13" placeholder="Search...">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-2 intro-y">
                        <select wire:model="downloadtype" class="form-select mt-5">
                            <option value="0">Select</option>
                            <option value="1">
                                XLSX
                            </option>
                            <option value="2">
                                XLS
                            </option>
                            <option value="3">
                                CSV
                            </option>
                            <option value="4">
                                PDF
                            </option>
                        </select>
                    </div>

                    <button wire:click="downloadfeedue"
                        class="btn btn-primary col-span-12 sm:col-span-2 intro-y mt-5">Download</button>
                @endif
            </div>
        </div>

        @if (!empty($studentduelist))
            <div class="flex flex-col mt-8 intro-y">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="table table-report">
                                <thead>
                                    <tr class="intro-x">
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold ">
                                            STUDENT NAME
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            ADMISSION NO
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            ROLL NO
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            FATHER NAME
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            AMOUNT <small>(Rs)</small>
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            DISCOUNT <small>(Rs)</small>
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            PAID <small>(Rs)</small>
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold ">
                                            BALANCE <small>(Rs)</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentduelist as $eachstudentduelist)
                                        <tr class="intro-x">
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->addmission_number }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->roll_no }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->aparent->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->feeassignstudent->sum('actual_amount') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->feeassignstudent->sum('discount_amount') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->feeassignstudent->sum('total_paid_amount') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstudentduelist->feeassignstudent->sum('due_amount') }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $studentduelist,
                ])
            </div>
        @elseif($classmasterid && $sectionid && empty($studentduelist))
            @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class and Section</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view fee due report</p>
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
