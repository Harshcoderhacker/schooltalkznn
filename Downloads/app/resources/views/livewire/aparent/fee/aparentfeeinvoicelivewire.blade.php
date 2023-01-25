<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('parent.fee.helper.parentfeemenu', ['active' => 'invoice'])
    </div>
    <div class="grid grid-cols-12 gap-1 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Invoice No
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Fee
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Amount
                            </div>
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Payment Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feestudentpayment as $eachfeestudentpayment)
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    #2012
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $eachfeestudentpayment->feemaster->name }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Rs. {{ round($eachfeestudentpayment->total_paid_amount, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $eachfeestudentpayment->created_at->format('M d, Y') }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary rounded-full">Download Invoice</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
