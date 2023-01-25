<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('parent.fee.helper.parentfeemenu', ['active' => 'fee'])
    </div>
    <div class="grid grid-cols-12 gap-1 mt-5">
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
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Action
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
                                    {{ $eachfeeassignstudent->feemaster->due_date }}
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
                            <td>
                                <div>
                                    @if ($eachfeeassignstudent->due_amount == 0)
                                        <button class="btn btn-secondary rounded-full text-black" disabled>Pay</button>
                                    @else
                                        <form action="{{ route('parentfeepaymentstore') }}" method="POST">
                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ $paymentintegration->gateway_secret_key }}"
                                                                                        data-amount="{{ round($eachfeeassignstudent->due_amount, 2) * 100 }}"
                                                                                        data-buttontext="Pay" data-name="EDFISH" data-description="Payment"
                                                                                        data-image="{{ asset('/image/logo/logo.png') }}"
                                                                                        data-prefill.name="{{ $eachfeeassignstudent->aparent->name }}"
                                                                                        data-prefill.contact="{{ $eachfeeassignstudent->aparent->phone }}"
                                                                                        data-prefill.email="{{ $eachfeeassignstudent->aparent->email }}"
                                                                                        data-theme.color="#0984E3">
                                            </script>
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <input type="hidden" name="uuid"
                                                value="{{ $eachfeeassignstudent->uuid }}">
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
