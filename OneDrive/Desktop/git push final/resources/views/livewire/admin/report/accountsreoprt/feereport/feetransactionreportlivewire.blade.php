<div>
    <div class="w-full mx-auto sm:w-11/12">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Fee Transaction Report</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 content-end gap-6 mt-2">
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <label for="input-wizard-2" class="form-label font-semibold">From</label>
                    <input type="date" class="form-control" wire:model="get_from_date">
                </div>
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <label for="input-wizard-2" class="form-label font-semibold">To</label>
                    <input type="date" class="form-control" wire:model="get_to_date">
                </div>
                @if (!empty($feestudentpaymentlist))
                    <div
                        class="intro-y col-span-12 sm:col-span-2 flex flex-wrap sm:flex-nowrap items-center mt-7 w-full">
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
                        <select wire:model="downloadtype" class="form-select mt-7">
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

                    <button wire:click="downloadfeetransaction"
                        class="btn btn-primary col-span-12 sm:col-span-2 intro-y mt-7">Download</button>
                @endif
            </div>
        </div>

        @if (!empty($feestudentpaymentlist))
            <div class="flex flex-col mt-8 intro-y">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="table table-report">
                                <thead>
                                    <tr class="intro-x">
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold ">
                                            PAYMENT ID
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            DATE
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            STUDENT NAME
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            CLASS - SECTION
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            FEE TYPE
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            MODE
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            AMOUNT <small>(Rs)</small>
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold">
                                            DISCOUNT <small>(Rs)</small>
                                        </th>
                                        <th scope="col" class="whitespace-wrap text-xs text-center font-semibold ">
                                            TOTAL <small>(Rs)</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feestudentpaymentlist as $eachfeestudentpaymentlist)
                                        <tr class="intro-x">
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->uniqid }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->created_at->format('d-M-Y') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->student->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->classmaster->name }} -
                                                {{ $eachfeestudentpaymentlist->section->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->feemaster->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ Config::get('archive.payment_mode')[$eachfeestudentpaymentlist->payment_mode] }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->amount_to_pay }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->discount_amount }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeestudentpaymentlist->total_paid_amount }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $feestudentpaymentlist,
                ])
            </div>
        @elseif($get_from_date && $get_to_date && empty($feestudentpaymentlist))
            @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">From Date, To Date</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view fee transaction report</p>
                    </div>
                    <div>
                        <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                                alt="ppl">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
