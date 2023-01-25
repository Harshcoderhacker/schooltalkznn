<div>
    <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
        <div class="box w-full mx-auto">
            <h1 class="px-5 mt-3 truncate sm:whitespace-normal font-medium text-lg"> Personal </h1>
            <div class="grid grid-cols-12 intro-y gap-4">
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">First Name</th>
                            <td>{{ $staff->name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Staff Id</th>
                            <td>{{ $staff->staff_roll_id }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Designation</th>
                            <td>{{ $staff->staffdesignation?->name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Date of Joining</th>
                            <td>{{ \Carbon\Carbon::parse($staff->doj)->format('j F, Y') }}</td>
                        </tr>
                        <tr class="intro-x" class="sm:hidden">
                            <th class="uppercase">Emerency Number</th>
                            <td>{{ $staff->emerency_number }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">Last Name</th>
                            <td>{{ $staff->last_name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Marital Status</th>
                            <td>{{ config('archive.marital_status')[$staff->marital_status] }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Department</th>
                            <td>{{ $staff->staffdepartment?->name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Date of Birth</th>
                            <td>{{ \Carbon\Carbon::parse($staff->dob)->format('j F, Y') }}</td>
                        </tr>
                        <tr class="intro-x" class="sm:hidden">
                            <th class="uppercase">Address</th>
                            <td>{{ $staff->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>




        <div class="box w-full mx-auto">
            <h1 class="px-5 mt-3 truncate sm:whitespace-normal font-medium text-lg"> Bank Information </h1>


            <div class="grid grid-cols-12 intro-y gap-4">
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">Account name</th>
                            <td>{{ $staff->staffotherdetail?->bank_name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Account Number</th>
                            <td>{{ $staff->staffotherdetail?->account_no }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">Bank Branch</th>
                            <td>{{ $staff->staffotherdetail?->bank_branch }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        <tr class="intro-x">
                            <th class="uppercase">Bank name</th>
                            <td>{{ $staff->staffotherdetail?->bank_name }}</td>
                        </tr>
                        <tr class="intro-x">
                            <th class="uppercase">IFSC Code</th>
                            <td>{{ $staff->staffotherdetail?->ifsc_code }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
