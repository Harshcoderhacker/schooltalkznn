<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        <div class=" col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header',
                    ['title' => 'Staff List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($payrolleachmonth->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                            <table class="table table-report sm:mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            @if (count($bulkselected) > 0)
                                                <button wire:click="generatebulkpayslip"
                                                    class="btn btn-primary w-full mt-3">Bulk Generate</button>
                                            @endif
                                        </th>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                NAME

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'name'])

                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">STATUS</th>
                                        <th class="text-center whitespace-nowrap">PAYSLIP</th>
                                        {{-- <th class="text-center whitespace-nowrap">DOWNLOAD</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payrolleachmonth as $index => $value)
                                        <tr class="intro-x">
                                            <td class="font-medium whitespace-nowrap">
                                                @if ($value->is_generated)
                                                    <div class="form-check form-switch flex flex-col items-start">
                                                        <input id="post-form-5" value="1" class="form-check-input"
                                                            type="checkbox" wire:model="bulkselectedchecked" disabled>
                                                    </div>
                                                @else
                                                    <div class="form-check form-switch flex flex-col items-start">
                                                        <input id="post-form-5" value="{{ $value->id }}"
                                                            class="form-check-input" type="checkbox"
                                                            wire:model="bulkselected">
                                                    </div>

                                                @endif
                                            </td>
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $payrolleachmonth->firstItem() + $index }}</td>
                                            <td class="font-medium whitespace-nowrap">{{ $value->name }}</td>
                                            <td
                                                class="font-semibold whitespace-nowrap {{ $value->is_generated ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $value->is_generated ? 'Generated' : 'Not Generated' }}</td>
                                            <td class="table-report__action w-50">
                                                @if ($value->is_generated)
                                                    @if ($value->is_paid)
                                                        <div
                                                            class="flex justify-center items-center divide-x divide-green-700 gap-2">
                                                            <a href="{{ route('generatepayroll', ['payrollid' => $payrollid, 'staffpayrollid' => $value->id]) }}"
                                                                class="font-semibold text-primary p-1">View Payroll</a>
                                                            <button wire:click="editpaysalary({{ $value->id }})"
                                                                class="font-semibold text-green-600 p-1">Paid
                                                                Salary</button>
                                                            <button
                                                                wire:click="viewanddownloadpayslip({{ $value->id }})"
                                                                class="font-semibold text-primary p-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                </svg>

                                                            </button>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="flex justify-center items-center divide-x divide-green-700 gap-2">
                                                            <a href="{{ route('generatepayroll', ['payrollid' => $payrollid, 'staffpayrollid' => $value->id]) }}"
                                                                class="font-semibold text-primary p-1">View Payroll</a>
                                                            <button wire:click="editpaysalary({{ $value->id }})"
                                                                class="font-semibold text-green-600 p-1">Pay
                                                                Salary</button>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="flex justify-center items-center gap-2">
                                                        <a href="{{ route('generatepayroll', ['payrollid' => $payrollid, 'staffpayrollid' => $value->id]) }}"
                                                            class="font-semibold text-primary p-1">Generate Payroll</a>
                                                    </div>
                                                @endif
                                            </td>
                                            {{-- <td class="table-report__action w-20">
                                        <div class="flex justify-center items-center">
                                            @include('helper.datatable.download',
                                            ['method' => 'deleteconfirm',
                                            'id' => $value->id])
                                        </div>
                                    </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', ['pagination' => $payrolleachmonth])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($showPaysalarymodal)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/2 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Pay Salary
                    </h3>
                    <button wire:click="closePaysalarymodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="updatepayrolleachmonth">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-4">
                                <label for="staff_name" class="form-label font-medium">Staff Name</label>
                                <input wire:model.lazy="staff_name" id="staff_name" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <label for="month_year" class="form-label font-medium">Month Year</label>
                                <input wire:model.lazy="month_year" id="month_year" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-span-12 sm:col-span-4">
                                <label for="net_salary" class="form-label font-medium">Payment Amount</label>
                                <input wire:model.lazy="net_salary" id="net_salary" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="payment_date" class="form-label font-medium">Payment Date</label>
                                <input wire:model.lazy="payment_date" id="payment_date" type="date" class="form-control"
                                    {{ $is_paid ? 'readonly' : '' }}>
                                @error('payment_date') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="payment_mode" class="form-label font-medium">Payment Method</label>
                                <select wire:model.lazy="payment_mode" id="payment_mode" id="payment_mode"
                                    class="form-select" {{ $is_paid ? 'readonly' : '' }}>
                                    <option>Select Transaction Mode</option>
                                    @foreach (config('archive.payment_mode') as $key => $value)
                                        <option value={{ $key }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_mode') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="description" class="form-label font-medium">Description
                                </label>
                                <textarea wire:model.lazy="description" id="description" name="description" type="text"
                                    class="form-control" {{ $is_paid ? 'readonly' : '' }}></textarea>
                                @error('description') <span
                                        class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (!$is_paid)
                        <div
                            class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button type="button" wire:click="closePaysalarymodal"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    @endif
    @if ($showDownloadpayslipmodal)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-3/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Pay Slip
                    </h3>
                    <button wire:click="closeDownloadpayslipmodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-2">
                    <div class="text-center">
                        <p class="text-primary font-semibold text-lg">Edfish School</p>
                        <p class="text-gray-700 font-semibold text-lg mt-3">1/169, Anna Nagar, Tuticorin - 628102</p>
                        <p class="text-primary font-semibold text-lg mt-3">Payslip for the period of
                            {{ Carbon\Carbon::parse($showpayrolleachmonth->month_string)->format('M Y') }}</p>
                    </div>
                    <div class="grid grid-cols-12 gap-1 mt-4 w-full sm:w-11/12 mx-auto">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
                            <p class="text-gray-700 font-semibold text-lg">{{ $showpayrolleachmonth->uniqid }}</p>
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
                                <p class="text-gray-700 font-semibold text-lg">Payment Date:
                                    {{ Carbon\Carbon::parse($showpayrolleachmonth->payment_date)->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-4 w-full sm:w-11/12 mx-auto">
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Staff ID
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['staff_roll_id'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Mobile
                                        </td>
                                        <td class="text-base">
                                            +91 {{ $staff['phone'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Role
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['role'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Designation
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['desgination'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-span-12 sm:col-span-6 intro-y">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Staff Name
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['name'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            E-Mail
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['email'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Department
                                        </td>
                                        <td class="text-base">
                                            {{ $staff['department'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary font-semibold text-lg">
                                            Date of Joining
                                        </td>
                                        <td class="text-base">
                                            {{ Carbon\Carbon::parse($staff['doj'])->format('d, M Y') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button wire:click="downloadpayslip" class="btn btn-primary">Download</button>
                    @if (auth()->user()->email)
                        <button wire:loading.remove wire:click="sendmailpayslip" class="btn btn-primary">Send
                            Mail</button>
                        <div wire:loading
                            class="col-span-6 sm:col-span-3 xl:col-span-2 flex flex-col justify-end items-center">
                            <i data-loading-icon="ball-triangle" class="w-8 h-8"></i>
                            <div class="text-center text-xs mt-2">Loading...</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
