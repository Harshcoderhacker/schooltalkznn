<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 3 ? '' : 'hidden' }}">
    @include('admin.accounts.fee.helper.createfeeformwizard', [
    'active' => 'assignfee',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="validateassignedstudent" autocomplete="off">
            <div class=" mx-auto w-2/3">
                <div class="intro-x col-span-12 sm:col-span-12">
                    <label for="assigntype" class="form-label font-semibold">Assign Fee For</label>
                    <select wire:model="assigntype" id="assigntype" class="w-full dark:bg-darkmode-700">
                        <option selected>Select</option>
                        <option value="1">All Students</option>
                        <option value="2">Selected Students</option>
                    </select>
                    @error('assigntype')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            @if ($assigntype == 2)
            <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
                <div class=" col-span-12">
                    <div class="p-2">
                        <div class="grid grid-cols-12 gap-1">
                            @include('helper.datatable.header', [
                            'title' => 'Student List',
                            'search' => 'searchTerm',
                            ])
                            <!-- BEGIN: Data List -->
                            @if ($studentlist)
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                                <table class="table table-report sm:mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap font-bold">
                                                R0LLNO
                                            </th>
                                            <th class="text-center whitespace-nowrap">
                                                <div class="flex">
                                                    NAME
                                                </div>
                                            </th>
                                            <th class="whitespace-nowrap">CLASS</th>
                                            <th class="whitespace-nowrap">SECTION</th>
                                            <th class="whitespace-nowrap">SELECT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentlist as $index => $eachstudent)
                                        <tr class="intro-x">
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $eachstudent->roll_no }}
                                            </td>
                                            <td class="font-medium whitespace-nowrap">
                                                {{ $eachstudent->name }}
                                            </td>
                                            <td class="font-semibold whitespace-nowrap">
                                                {{ $eachstudent->classmaster->name }}
                                            </td>
                                            <td class="font-semibold whitespace-nowrap">
                                                {{ $eachstudent->section->name }}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch flex flex-col items-start">
                                                    <input id="post-form-5" class="form-check-input"
                                                        value="{{ $eachstudent->id }}" type="checkbox"
                                                        wire:model="selectedstudent" {{
                                                        $eachstudent->selectedfeeassignstudent($feemaster_id) ?
                                                    'disabled' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            @include('helper.datatable.norecordfound')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                @if ($feeassignstudentlock)
                <button type="submit" class="btn btn-primary w-24 ml-2">Next</a>
                    @else
                    <button type="button" wire:click="back(2)" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Next</a>
                        @endif
            </div>
        </form>
    </div>
</div>