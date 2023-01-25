<div>
                @if($feeassignstudent)
                <div class="box intro-y col-span-6 sm:col-span-12 overflow-auto lg:overflow-visible p-2 mt-5">
                    <div class=" mt-5">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Fee
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Due Date
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                status
                                            </div>
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Amount
                                        </th>
                
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Paid
                                        </th>
                                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                                            <div class="flex">
                                                Balance
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feeassignstudent as $eachfeeassignstudent)
                                        <tr class="intro-x">
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ $eachfeeassignstudent->feemaster->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($eachfeeassignstudent->feemaster->due_date)->format('d-m-Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($eachfeeassignstudent->due_amount == 0)
                                                    <span
                                                        class="bg-success text-white w-full rounded-full px-6 py-3 font-bold">Paid</span>
                                                @elseif ($eachfeeassignstudent->due_amount != 0 && $eachfeeassignstudent->is_lock)
                                                    <span
                                                        class="bg-warning text-white w-full rounded-full px-6 py-3 font-bold">Partially
                                                        Paid</span>
                                                @else
                                                    <span class="bg-danger text-white w-full rounded-full px-6 py-3 font-bold">Not
                                                        Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    Rs. {{ round($eachfeeassignstudent->actual_amount, 2) }}
                                                </span>
                                            </td>
                
                                            <td>
                                                <span class="text-sm font-medium text-center">
                                                    Rs. {{ round($eachfeeassignstudent->total_paid_amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium text-center">
                                                    Rs. {{ round($eachfeeassignstudent->due_amount, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                @include('helper.datatable.norecordfound')
                @endif
</div>
