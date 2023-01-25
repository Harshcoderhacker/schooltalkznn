<div>
    <div id="payroll" class="tab-pane" role="tabpanel" aria-labelledby="payroll-tab">
    <div class="box grid grid-cols-12 intro-y mt-2 gap-4 w-full sm:w-11/12 mx-auto">
        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
            <tbody class="divide-y-2">
                <tr class="intro-x">
                    <th class="uppercase">EDF Number</th>
                    <td>{{ $staff->edf_number }}</td>
                </tr>
                <tr class="intro-x">
                    <th class="uppercase">Basic Salary</th>
                    <td>{{ $staff->basic_salary }}</td>
                </tr>
                <tr class="intro-x" class="sm:hidden">
                    <th class="uppercase"></th>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
            <tbody class="divide-y-2">
                <tr class="intro-x">
                    <th class="uppercase">Contract Type</th>
                    <td>
                        @if ($staff->contract_type_id)
                        {{ config('archive.contract_type')[$staff->contract_type_id] }}
                        @endif
                    </td>
                </tr>

                <tr class="intro-x">
                    <th class="uppercase">Location</th>
                    <td>{{ $staff->location }}</td>
                </tr>
                <tr class="intro-x" class="sm:hidden">
                    <th class="uppercase"></th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
