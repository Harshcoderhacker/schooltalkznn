<div>
    <div class="intro-y chat grid grid-cols-12 gap-5">
        <div class=" col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <h2 class="intro-y text-xl font-medium mt-3">Payroll List</h2>
                        <div class="hidden md:block mx-auto text-slate-500"></div>
                        <div class="flex gap-5 w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-slate-500">
                                <input wire:model="searchTerm" type="text" class="form-control w-56 box pr-10"
                                    placeholder="Search...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                            </div>
                            <button wire:click="isModalFormOpen" class="btn btn-primary shadow-md mr-2">Create
                                Payroll</button>
                        </div>
                    </div>

                    <!-- BEGIN: Data List -->
                    @if ($payroll->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            ID
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                PAYROLL MONTH
                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'month_date'])
                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">CREATED BY</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                        <th class="text-center whitespace-nowrap">PAYROLL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payroll as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $payroll->firstItem() + $index }}</td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($value->month_date)->format('M-Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->created_by }}
                                                </span>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'payroll-show',
                                                    'method' => 'show',
                                                    'id' => $value->id])

                                                    @include('helper.datatable.edit',
                                                    ['method' => 'edit',
                                                    'id' => $value->id])

                                                </div>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">
                                                    <a href="{{ route('payrollstafflist', $value->id) }}"
                                                        class="btn btn-primary shadow-md">Payroll</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', ['pagination' => $payroll])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
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
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        {{ $payrollid ? 'Update' : 'Create' }} Payroll
                    </h3>
                    <button wire:click="closeFormModalPopover"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="createorupdatepayroll">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">Payroll Month</label>
                                <input wire:model="month_string" name="month_string" type="month" class="form-control"
                                    placeholder="MMM-YYY">
                                @error('month_string') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label class="form-label font-medium">No.of Working Days</label>
                                <input wire:model="tot_no_of_working_days" name="tot_no_of_working_days" type="number"
                                    class="form-control" autocomplete="off">
                                @error('tot_no_of_working_days') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="form-label font-medium">Remarks</label>
                                <textarea wire:model="remarks" name="remarks" type="text" class="form-control"
                                    placeholder="Remarks..."></textarea>
                                @error('remarks') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="closeFormModalPopover"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @include('livewire.admin.staff.payroll.payrollshow')
</div>
