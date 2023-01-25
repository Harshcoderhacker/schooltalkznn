<div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-8">
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Fee</h2>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
            <div class="relative text-gray-700 dark:text-gray-300">
                <a href="{{ route('createfee') }}" class="btn btn-primary w-24 ml-2">Add Fee</a>
            </div>
        </div>
    </div>
    @if ($feemasterdata->isNotEmpty())
    <div class="flex flex-col mt-3 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Fee
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
                                    Particulars
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feemasterdata as $eachfeemaster)
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ $eachfeemaster->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ $eachfeemaster->classmaster->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ $eachfeemaster->classmaster->section->whereIn('id',
                                        $eachfeemaster->section)->pluck('name')->implode(', ') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ $eachfeemaster->feeparticular_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ round($eachfeemaster->amount, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        {{ $eachfeemaster->due_date }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex gap-1 ">
                                        <button class="text-green-600"
                                            wire:click="openfeedetailsmodal({{ $eachfeemaster->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                </path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg></button>
                                        <a
                                            href="{{ route('editfee', ['feemaster' => $eachfeemaster->id, 'show' => $eachfeemaster->feestudentpayment ? 3 : 1]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg></a>
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
    @else
    @include('helper.datatable.norecordfound')
    @endif

    @if ($showfeedetailsmodal)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closefeedetailsemodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative md:w-2/5 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        Fee Details
                    </h3>
                    <button type="button" wire:click="closefeedetailsemodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-12 gap-4 my-3">
                        <div class="col-span-6 sm:col-span-12"><span class="font-bold">Fee Category:</span>
                            {{ $feemaster->name }}
                        </div>
                        <div class="col-span-12 flex justify-between">
                            <div><span class="font-bold">Class:</span> {{ $feemaster->classmaster->name }}
                                -
                                {{ $feemastersection }}
                            </div>
                            <div class=""><span class="font-bold">Due Date:</span>
                                {{ date('d-M-Y', strtotime($feemaster->due_date)) }}
                            </div>
                        </div>
                        <div class="col-span-12 mt-5">
                            <div class="font-bold text-center">Fee Particulars</div>
                            <div class="bg-gray-200 rounded mt-3 p-4">
                                @foreach ($feemaster->feemasterparticular as $eachfeeparticular)
                                <div class="flex justify-between mb-2">
                                    <div>{{ $eachfeeparticular->feeparticular->name }}</div>
                                    <div>{{ $eachfeeparticular->amount }}</div>
                                </div>
                                @endforeach
                                <div class="flex justify-between">
                                    <div class="font-bold">Total</div>
                                    <div>{{ $feemaster->feemasterparticular->sum('amount') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 mt-2">
                            <div class="flex justify-between">
                                <div class="text-danger">Total Students:
                                    {{ $feemaster->feeassignstudent->where('is_selected', true)->count() }}</div>
                                <div class="text-danger">Paid:
                                    {{ $feemaster->feeassignstudent->where('due_amount', 0)->count() }}</div>
                                <div class="text-danger">Unpaid:
                                    {{ $feemaster->feeassignstudent->where('due_amount', '!=', 0)->where('is_selected',
                                    true)->count() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 mt-3">
                            <div class="bg-gray-200 rounded p-5">
                                <div class="flex justify-between text-green-600">
                                    <div class="">Fee Collected</div>
                                    <div class="">Rs:
                                        {{ $feemaster->feeassignstudent->where('is_selected',
                                        true)->sum('total_paid_amount') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 mt-3">
                            <div class="bg-gray-200 rounded p-5">
                                <div class="flex justify-between text-danger">
                                    <div class="">Fee Pending</div>
                                    <div class="">Rs:
                                        {{ $feemaster->feeassignstudent->where('is_selected', true)->sum('due_amount')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" text-center">
                        <button wire:click="closefeedetailsemodal()" type="button" class="btn btn-danger">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>