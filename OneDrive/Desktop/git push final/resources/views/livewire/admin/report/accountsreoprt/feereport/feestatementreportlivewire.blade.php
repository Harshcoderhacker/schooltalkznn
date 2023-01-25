<div>
    <div class="w-full mx-auto sm:w-11/12">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Fee Statement Report</h2>
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
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="studentid" class="form-select w-full mt-5">
                        <option value="0">Select Student </option>
                        @foreach ($student as $eachstudent)
                            <option value="{{ $eachstudent->id }}">
                                {{ $eachstudent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($feeassignstudent->isNotEmpty())
                    <button wire:click="downloadfeestatement"
                        class="btn btn-primary col-span-12 sm:col-span-3 intro-y mt-5">Download Pdf</button>
                @endif
            </div>
        </div>
        @if ($feeassignstudent->isNotEmpty())
            <div class="grid grid-cols-12 intro-y gap-4 text-xs mt-4 rounded">
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">First Name</th>
                            <td>{{ $studentdetails->name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Father Name</th>
                            <td>{{ $studentdetails->aparent->name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Mobile Number</th>
                            <td>{{ $studentdetails->phone_no }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">Last Name</th>
                            <td>{{ $studentdetails->last_name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Admission Number</th>
                            <td>{{ $studentdetails->addmission_number }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Roll Number</th>
                            <td>{{ $studentdetails->roll_no }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col mt-8 intro-y">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="table table-report">
                                <thead>
                                    <tr class="intro-x">
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Fee
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Fee Particular
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Amount <small>(Rs)</small>
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Payment ID
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Mode
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Date
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Discount <small>(Rs)</small>
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Paid <small>(Rs)</small>
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Balance <small>(Rs)</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feeassignstudent as $eachfeeassignstudent)
                                        <tr class="intro-x">
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->feemaster->name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->feemaster->feeparticular_name }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->due_amount == 0 ? 'Paid' : 'Unpaid' }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->actual_amount }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap"></td>
                                            <td class="text-xs text-center whitespace-wrap"></td>
                                            <td class="text-xs text-center whitespace-wrap"></td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->feestudentpayment->sum('discount_amount') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->total_paid_amount }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachfeeassignstudent->due_amount }}
                                            </td>
                                        </tr>

                                        @foreach ($eachfeeassignstudent->feestudentpayment as $key => $eachfeestudentpayment)
                                            <tr>
                                                <td class="text-xs text-center" style="
                                                    background-color:#efe1e100;box-shadow:none;">

                                                </td>
                                                <td class="text-xs text-center" style="
                                                    background-color:#efe1e100;box-shadow:none;">

                                                </td>
                                                <td class="text-xs text-center" style="
                                                    background-color:#efe1e100;box-shadow:none;">

                                                </td>
                                                <td class="text-xs float-right whitespace-wrap">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ $eachfeestudentpayment->uniqid }}
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ Config::get('archive.payment_mode')[$eachfeestudentpayment->payment_mode] }}
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ $eachfeestudentpayment->created_at->format('d-M-Y h:i') }}
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ $eachfeestudentpayment->discount_amount }}
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ $eachfeestudentpayment->total_paid_amount }}
                                                </td>
                                                <td class="text-xs text-center whitespace-wrap">
                                                    {{ $eachfeestudentpayment->due_amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $feeassignstudent,
                ])
            </div>
        @elseif($classmasterid && $sectionid && $studentid && $feeassignstudent->isEmpty())
            @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Student</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view fee statement report</p>
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
