@if ($showinactiveuserrightnav)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closeinactiveusermodal" class="absolute inset-0 bg-gray-500 opacity-75">
        </div>
        <div class="relative md:w-2/5 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        Inactive User
                    </h3>
                    <button type="button" wire:click="closeinactiveusermodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto h-5/6">
                    <div class="text-primary font-bold text-lg">Students:</div>
                    <table class="table-auto w-full">
                        <tbody class="font-bold">
                            @foreach ($inactiveuserlist[2] as $eachinactivestudent)
                                <tr>
                                    <td>
                                        <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                            @if ($eachinactivestudent->avatar)
                                                <img alt="{{ $eachinactivestudent->name }} image" class="rounded-full"
                                                    src="{{ url('storage/' . $eachinactivestudent->avatar) }}">
                                            @else
                                                <img alt="{{ $eachinactivestudent->name }} image" class="rounded-full"
                                                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $eachinactivestudent->name }}</td>
                                    <td class="text-primary">{{ $eachinactivestudent->classmaster->name }} -
                                        {{ $eachinactivestudent->section->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <div class="text-primary font-bold text-lg my-3">Staffs:</div>
                    <table class="table-auto w-full">
                        <tbody class="font-bold">
                            @foreach ($inactiveuserlist[1] as $eachinactivestaff)
                                <tr>
                                    <td>
                                        <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                            @if ($eachinactivestaff->avatar)
                                                <img alt="{{ $eachinactivestaff->name }} image" class="rounded-full"
                                                    src="{{ url('storage/' . $eachinactivestaff->avatar) }}">
                                            @else
                                                <img alt="{{ $eachinactivestaff->name }} image" class="rounded-full"
                                                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $eachinactivestaff->name }}</td>
                                    <td class="text-primary">{{ $eachinactivestaff->staffdepartment->name }} -
                                        {{ $eachinactivestaff->staffdesignation->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="text-primary font-bold text-lg my-3">User:</div>
                    <table class="table-auto w-full">
                        <tbody class="font-bold">
                            @foreach ($inactiveuserlist[0] as $eachinactiveuser)
                                <tr>
                                    <td>
                                        <div class="w-8 h-8 my-3 rounded-full overflow-hidden shadow-lg image-fit">
                                            @if ($eachinactiveuser->avatar)
                                                <img alt="{{ $eachinactiveuser->name }} image" class="rounded-full"
                                                    src="{{ url('storage/' . $eachinactiveuser->avatar) }}">
                                            @else
                                                <img alt="{{ $eachinactiveuser->name }} image" class="rounded-full"
                                                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $eachinactiveuser->name }}</td>
                                    <td class="text-primary"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
