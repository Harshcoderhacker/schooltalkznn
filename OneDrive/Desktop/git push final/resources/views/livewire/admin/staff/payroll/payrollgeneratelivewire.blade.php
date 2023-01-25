<div>
    <div class=" col-span-12 xl:col-span-12 mt-20">
        <div class="box p-0 mt-5 sm:p-5">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-3 intro-y">
                    @if ($staff->avatar)
                        <img class="-mt-20 mx-auto rounded-full w-32 h-32"
                            src="{{ url('storage/' . $staff->avatar) }}">
                    @else
                        <img alt="edfish" class="-mt-20 mx-auto rounded-full w-32 h-32"
                            src="{{ asset('image/dummy/200x200.jpg') }}">
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-4 intro-y">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Staff ID
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['staff_roll_id'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Mobile
                                </td>
                                <td class="text-sm">
                                    +91 {{ $staffdetails['phone'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Role
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['role'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Designation
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['desgination'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 sm:col-span-4 intro-y">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Staff Name
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    E-Mail
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['email'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Department
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['department'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary font-semibold text-sm">
                                    Date of Joining
                                </td>
                                <td class="text-sm">
                                    {{ $staffdetails['doj'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 sm:col-span-4 intro-y">
                    <div class="box p-3 bg-primary intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="mr-auto">
                                <div class="text-white font-semibold text-sm">
                                    Number of day Present
                                </div>
                            </div>
                            <p class="justify-center w-12 text-white">
                                {{ $no_of_days_present }}
                            </p>
                        </div>
                    </div>
                    <div class="box p-3 mt-2 bg-primary intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="mr-auto">
                                <div class="text-white font-semibold text-sm">
                                    Number of Days Absent
                                </div>
                            </div>
                            <p class="justify-center w-12 text-white">
                                {{ $no_of_days_absent }}
                            </p>
                        </div>
                    </div>
                    <div class="box p-3 mt-2 bg-primary intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="mr-auto">
                                <div class="text-white font-semibold text-sm">
                                    LOP
                                </div>
                            </div>
                            <p class="justify-center w-12 text-white">
                                {{ $lop }}
                            </p>
                        </div>
                    </div>
                    <div class="box p-3 mt-2 bg-primary intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="mr-auto">
                                <div class="text-white font-semibold text-sm">
                                    Half Day
                                </div>
                            </div>
                            <p class="justify-center w-12 text-white">
                                {{ $halfdays }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($staffpayroll_generated)
        <div class="grid grid-cols-12 gap-6 mt-8">
            {{-- Earnings --}}
            @include('livewire.admin.staff.payroll.completedpayrollbreak.earning')
            {{-- Deduction --}}
            @include('livewire.admin.staff.payroll.completedpayrollbreak.deduction')
            {{-- Payroll Summary --}}
            @include('livewire.admin.staff.payroll.completedpayrollbreak.payrollsummary')
        </div>
    @else
        <div class="grid grid-cols-12 gap-6 mt-8">
            {{-- Earnings --}}
            @include('livewire.admin.staff.payroll.payrollbreakup.earning')
            {{-- Deduction --}}
            @include('livewire.admin.staff.payroll.payrollbreakup.deduction')
            {{-- Payroll Summary --}}
            @include('livewire.admin.staff.payroll.payrollbreakup.payrollsummary')
        </div>
        @if (!$staffpayroll_generated)
            <button wire:click="generatepayroll" class="float-right btn btn-primary rouded-full mt-5">Generate
                Payroll</button>
        @endif
    @endif
</div>
