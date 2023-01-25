<div>
    <div class="col-span-12 mt-3">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Student Info</h2>
        </div>
    </div>
    <div class="intro-y">
        <table class=" table w-max mx-auto mt-3 bg-primary rounded-lg">
            <tbody class="text-white divide-y-2">
                <tr class="intro-x">
                    <th class="font-black uppercase">NAME</th>
                    <td>{{ $student->name }} {{ $student->last_name }}</td>
                    <th class="font-black uppercase">Class & Section</th>
                    <td>{{ $student->classmaster->name }} - {{ $student->section->name }}</td>
                </tr>
                <tr class="intro-x">
                    <th class="font-black uppercase">Father's Name</th>
                    <td>{{ $student->aparent->name }}</td>
                    <th class="font-black uppercase">Admission Number</th>
                    <td>{{ $student->addmission_number }}</td>
                </tr>
                <tr class="intro-x">
                    <th class="font-black uppercase">Contact Number</th>
                    <td>+91 {{ $student->phone_no }}</td>
                    <th class="font-black uppercase">Roll Number</th>
                    <td>{{ $student->roll_no }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Fee Data</h2>
        </div>
    </div>
    <div class="flex flex-col intro-y">
        <div class="-my-2 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Fee Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Paid
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Balance
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feeassignstudentlist as $eachfeeassignstudentlist)
                                <tr class="intro-x">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="w-auto">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachfeeassignstudentlist->feemaster->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            {{ $eachfeeassignstudentlist->feemaster->due_date }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($eachfeeassignstudentlist->due_amount == 0)
                                            <span class="btn btn-elevated-rounded-success w-24">Paid</span>
                                        @elseif ($eachfeeassignstudentlist->due_amount != 0 && $eachfeeassignstudentlist->is_lock)
                                            <span class="btn btn-elevated-rounded-warning w-24">Partially Paid</span>
                                        @else
                                            <span class="btn btn-elevated-rounded-danger w-24">Not Paid</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            Rs.{{ round($eachfeeassignstudentlist->actual_amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            Rs.{{ round($eachfeeassignstudentlist->total_paid_amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                            Rs.{{ round($eachfeeassignstudentlist->due_amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="text-center whitespace-nowrap">
                                        @if ($eachfeeassignstudentlist->due_amount == 0)
                                            <button class="btn btn-elevated-rounded-secondary w-20 hover-none"
                                                disabled>Pay</button>
                                        @else
                                            <button
                                                wire:click="payfeeopenformModal({{ $eachfeeassignstudentlist->id }})"
                                                class="btn btn-rounded-primary w-20">Pay</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    @if ($isModalFormOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-3/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Pay Fee
                    </h3>
                    <button wire:click="payfeecloseFormModal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-0 sm:p-10">
                    <form wire:submit.prevent="payfeestore" enctype="multipart/form-data">
                        <table class="table w-full mx-auto">
                            <tbody class="divide-y">
                                <tr class="intro-x">
                                    <td class="font-semibold">Name: {{ $student->name }}
                                        {{ $student->last_name }}
                                    </td>
                                    <td class="font-semibold">Class & Section: {{ $student->classmaster->name }} -
                                        {{ $student->section->name }}</td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="font-black text-theme-1 uppercase">Fee Type</th>
                                    <td>{{ $feeassignstudent->feemaster->name }}</td>
                                    <th class="font-black text-theme-1 uppercase">Particulars</th>
                                    <td>{{ $feeassignstudent->feemaster->feeparticular_name }}
                                    </td>
                                </tr>
                                <tr class="intro-x">
                                    <th class="font-black text-theme-1 uppercase">Amount to Pay</th>
                                    <td>Rs.{{ round($feeassignstudent->due_amount, 2) }}</td>
                                    <th class="font-black text-theme-1 uppercase">Discount</th>
                                    <td>
                                        <select wire:model="feediscount_id" wire:change="calculatetotalpaid()"
                                            wire:keyup="calculatetotalpaid()" class="form-select w-full mt-5">
                                            <option selected>Select Discount </option>
                                            @foreach ($feediscount as $eachfeediscount)
                                                <option value="{{ $eachfeediscount->id }}">
                                                    {{ $eachfeediscount->name }} ({{ $eachfeediscount->amount }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                </tr>
                                <tr class="intro-x">
                                    <th class="font-black text-theme-1 uppercase">Paying</th>
                                    <td>
                                        <input autocomplete="off" wire:model.lazy="paying_amount"
                                            wire:change="calculatetotalpaid()" wire:keyup="calculatetotalpaid()"
                                            id="paying_amount_id" type="number" class="form-control">
                                        @error('paying_amount')
                                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <th class="font-black text-theme-1 uppercase">Payment Mode</th>
                                    <td>
                                        <select wire:model="payment_mode" class="form-select w-full mt-5">
                                            <option selected>Select Payment Mode </option>
                                            @foreach (config('archive.payment_mode') as $key => $value)
                                                <option value={{ $key }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr class="intro-x">

                                    <th class="font-black text-theme-1 uppercase">Document</th>
                                    <td>
                                        <input wire:model.lazy="payment_document" type="file" class="form-control">
                                        @error('payment_document')
                                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-black text-theme-1 uppercase">Notes</th>
                                    <td colspan="3">
                                        <textarea class="w-full form-control" wire:model.lazy="remarks"></textarea>
                                        @error('remarks')
                                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table w-1/2 mx-auto sm:mx-0 bg-primary text-theme-14">
                            <tr class="intro-x text-lg">
                                <td class="font-semibold text-white">Remaining Due : Rs.{{ $due_amount }}</th>
                                <td class="font-semibold text-white">Total Paid : Rs.{{ $total_paid_amount }}</td>
                            </tr>
                        </table>
                        <div
                            class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button type="button" wire:click="payfeecloseFormModal"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
