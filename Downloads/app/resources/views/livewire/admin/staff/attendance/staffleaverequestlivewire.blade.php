<div>
    <div class=" col-span-12 xl:col-span-12 ">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-3 ">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    @if ($panel == 'pending')
                        <h2 class="text-lg font-bold text-theme-1 mr-5">Leave Request</h2>
                    @elseif($panel == 'approved')
                        <h2 class="text-lg font-bold text-theme-1 mr-5">Approved Leaves</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.staff.attendance.helper.staffleavemenu', ['active' => $panel])
    </div>
    @if ($panel == 'pending')
        <div class="flex flex-col mt-8 intro-y">
            @if ($staffleaverequest->isNotEmpty())
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Leave Type
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            From
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            To
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Reason
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffleaverequest as $value)
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->staff->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->leavetype->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ \Carbon\Carbon::parse($value->from_date)->format('d, M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ \Carbon\Carbon::parse($value->to_date)->format('d, M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->staff->staffdesignation->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4  break-words whitespace-wrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->reason }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap flex">
                                                <div wire:click="openleaverequestmodal({{ $value->id }})"
                                                    class="btn btn-primary rounded-full">
                                                    View and
                                                    Approve</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('helper.datatable.pagination', ['pagination' => $staffleaverequest])
            @else
                @include('helper.datatable.norecordfound')
            @endif
        </div>
    @elseif($panel == 'approved' || $panel == 'decline')
        <div class="flex flex-col mt-8 intro-y">
            @if ($staffleaverequest->isNotEmpty())
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Staff Id
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Staff Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Leave Type
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            From
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            To
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Reason
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffleaverequest as $value)
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->staff->staff_roll_id }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->staff->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->staff->staffdesignation->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $value->leavetype->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ \Carbon\Carbon::parse($value->from_date)->format('d, M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ \Carbon\Carbon::parse($value->to_date)->format('d, M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 w-1/2 break-words whitespace-wrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                                    {{ $value->reason }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('helper.datatable.pagination', ['pagination' => $staffleaverequest])
            @else
                @include('helper.datatable.norecordfound')
            @endif
        </div>
    @endif
    {{-- Modal --}}
    @if ($isshowmodalopen && $leaverequestshowdata)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-8/12 shadow-2xl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h2 class="font-bold text-lg text-white mr-auto">Leave Request</h2>
                            <button wire:click="leaverequestclosemodal"
                                class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="modal-body p-0 sm:p-10 col-span-12">

                                <table class="table w-full mx-auto">
                                    <tbody class="divide-y">
                                        <tr class="intro-x">
                                            <th class="font-semibold">Name:</th>
                                            <td> {{ $leaverequestshowdata->staff->name }}</td>
                                            <th class="font-semibold">Role:</th>
                                            <td> {{ $leaverequestshowdata->staff->staffdesignation->name }}</td>
                                        </tr>
                                        <tr class="intro-x">
                                            <th class="font-black text-theme-1 uppercase">Leave Type</th>
                                            <td>{{ $leaverequestshowdata->leavetype->name }}</td>
                                            <th class="font-black text-theme-1 uppercase">Reason</th>
                                            <td>{{ $leaverequestshowdata->reason }}</td>
                                        </tr>
                                        <tr class="intro-x">
                                            <th class="font-black text-theme-1 uppercase">From</th>
                                            <td>{{ \Carbon\Carbon::parse($leaverequestshowdata->from_date)->format('d, M Y') }}
                                            </td>
                                            <th class="font-black text-theme-1 uppercase">to</th>
                                            <td>{{ \Carbon\Carbon::parse($leaverequestshowdata->to_date)->format('d, M Y') }}
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <th class="font-black text-theme-1 uppercase">No.of Days</th>
                                            <td>{{ $diff }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="grid grid-cols-12 mt-8 gap-4">
                                    <div class="col-span-12 sm:col-span-6">
                                        <table class="table mx-auto sm:mx-0 bg-primary text-theme-14">
                                            <tr class="intro-x">
                                                <td class="font-semibold">Alloted Leaves</th>
                                                <td class="font-semibold">25</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <select name="is_approved" wire:model.lazy="is_approved" id="is_approved"
                                            class="form-select">
                                            <option>Select A Status</option>
                                            @foreach (config('archive.form_status') as $key => $value)
                                                <option value={{ $key }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('is_approved')
                                            <span class="text-red-600 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div
                            class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button type="button" wire:click="leaverequestclosemodal"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                            <button wire:click="approveleave({{ $leaverequestid }})"
                                class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
