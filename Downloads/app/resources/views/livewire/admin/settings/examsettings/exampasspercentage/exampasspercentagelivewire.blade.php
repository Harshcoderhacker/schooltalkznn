<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include(
            'admin.settings.examsettings.helper.examsettingsmenu',
            ['active' => 'exampasspercentage']
        )
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        <div class="col-span-12 xl:col-span-4">
            <div class="intro-y block sm:flex items-center h-10 mx-5">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Pass Percentage</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5 shadow">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input wire:model="pass_percentage" type="number"
                            class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Percentage *" id="section_field_focus" autocomplete="off" autofocus>
                        @error('pass_percentage')
                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($passpercentageid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" {{ $percentagebtn ? 'disabled' : '' }}
                                class="btn btn-primary">Update
                                Pass Percentage</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" {{ $percentagebtn ? 'disabled' : '' }}
                            class="btn btn-primary w-full mt-3">Add Pass Percentage</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header', [
                        'title' => 'Pass Percentage List',
                        'search' => 'searchTerm',
                    ])
                    <!-- BEGIN: Data List -->
                    @if ($passpercentage->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                Pass Percentage

                                                @include('helper.datatable.sorting', [
                                                    'method' => 'sortBy',
                                                    'value' => 'pass_percentage',
                                                ])

                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($passpercentage as $index => $value)
                                        <tr class="intro-x">
                                            <td>{{ $passpercentage->firstItem() + $index }}</td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->pass_percentage }}
                                                    %</span>
                                            </td>
                                            <td>
                                                @include('helper.datatable.edit', [
                                                    'method' => 'edit',
                                                    'id' => $value->id,
                                                ])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', [
                            'pagination' => $passpercentage,
                        ])
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Pass Percentage</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create pass percentage</p>
                            </div>
                            <div>
                                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character2.png') }}"
                                        alt="ppl">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
