<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.leavesettings.helper.leavesettingsmenu', ['active' => 'leavedefine'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 ">
        <div class="col-start-2 col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Leave Define</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300 mb-2">
                        <label for="leavedefine_field_focus" class="form-label font-medium">Academic Year</label>
                        <select wire:model="academicyear_id" id="leavedefine_field_focus" class="form-select w-full">
                            <option value="0">Select Academic year </option>
                            @foreach ($academicyear as $eachacademicyear)
                                <option value="{{ $eachacademicyear->id }}">
                                    {{ $eachacademicyear->year }}
                                </option>
                            @endforeach
                        </select>
                        @error('academicyear_id')
                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative text-gray-700 dark:text-gray-300">
                        <label for="alloted_days_label" class="form-label font-medium">Alloted
                            Days</label>
                        <input wire:model="alloteddays" type="number"
                            class="form-control py-2 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Alloted Days*" id="alloted_days_label" autocomplete="off">
                        @error('alloteddays') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative text-gray-700 dark:text-gray-300">
                        <label for="monthly_leave_label" class="form-label font-medium">Montly Leave</label>
                        <input wire:model="monthlyleave" type="number"
                            class="form-control py-2 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Montly Leave*" id="monthly_leave_label" autocomplete="off">
                        @error('monthlyleave') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($leavedefineid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" {{ $leavedefinesubmitbtn ? 'disabled' : '' }}
                                class="btn btn-primary">Update Leave Define</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" {{ $leavedefinesubmitbtn ? 'disabled' : '' }}
                            class="btn btn-primary w-full mt-3">Add Leave Define</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header',
                    ['title' => 'Leave Define List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($leavedefine->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                ACADEMIC YEAR

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'created_at'])

                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                ALLOTED DAYS
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                MONTHLY LEAVE
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leavedefine as $index => $value)
                                        <tr class="intro-x">
                                            <td>{{ $leavedefine->firstItem() + $index }}</td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->academicyear?->year }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->alloteddays }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->monthlyleave }}</span>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'leavedefine-show',
                                                    'method' => 'show',
                                                    'id' => $value->id])

                                                    @include('helper.datatable.edit',
                                                    ['method' => 'edit',
                                                    'id' => $value->id])

                                                    @include('helper.datatable.delete',
                                                    ['method' => 'deleteconfirm',
                                                    'id' => $value->id])

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', ['pagination' => $leavedefine])
                    @elseif($searchTerm && $leavedefine->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select and Enter</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Academic year, Alloted Days and Monthly Leave</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create leave define</p>
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
        </div>
    </div>
    @include('livewire.admin.settings.leavesettings.leavedefine.leavedefineshow')
</div>
