<div>
    <div>
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
            @include(
                'admin.settings.examsettings.helper.examsettingsmenu',
                ['active' => 'examgrade']
            )
        </div>
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
            <div class="col-span-12 xl:col-span-4">
                <div class="intro-y block sm:flex items-center h-10 mx-5">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Grade</h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5 shadow">
                    <form wire:submit.prevent="createorupdate">
                        <div class="relative text-gray-700 dark:text-gray-300">
                            <div>
                                <label for="name_id" class="form-label font-medium">Grade Name</label>
                                <input wire:model="name" type="text"
                                    class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                                    placeholder="Grade Name *" id="name_id" autocomplete="off" autofocus>
                                @error('name')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="from_id" class="form-label font-medium mt-2">Percentage From</label>
                                <input wire:model="percentage_from" type="number"
                                    class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                                    placeholder="Percentage From *" id="from_id" autocomplete="off" autofocus>
                                @error('percentage_from')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="to_id" class="form-label font-medium mt-2">Percentage to</label>
                                <input wire:model="percentage_to" type="number"
                                    class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                                    placeholder="percentage To *" id="to_id" autocomplete="off" autofocus>
                                @error('percentage_to')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($gradeid)
                            <div class="flex mt-3 gap-2 justify-center">
                                <button type="submit" {{ $gradebtn ? 'disabled' : '' }} class="btn btn-primary">Update
                                    Grade</button>
                                <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                            </div>
                        @else
                            <button type="submit" {{ $gradebtn ? 'disabled' : '' }}
                                class="btn btn-primary w-full mt-3">Add Grade</button>
                        @endif
                    </form>
                </div>
            </div>
            <div class=" col-span-12 xl:col-span-8 ">
                <div class="p-2">
                    <div class="grid grid-cols-12 gap-1">
                        @include('helper.datatable.header', [
                            'title' => 'Grade List',
                            'search' => 'searchTerm',
                        ])
                        <!-- BEGIN: Data List -->
                        @if ($examgrade->isNotEmpty())
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-report -mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">
                                                S.NO
                                            </th>
                                            <th class="text-center whitespace-nowrap">
                                                <div class="flex">
                                                    Grade Name

                                                    @include('helper.datatable.sorting', [
                                                        'method' => 'sortBy',
                                                        'value' => 'name',
                                                    ])
                                                </div>
                                            </th>
                                            <th class="whitespace-nowrap">
                                                Percentage
                                            </th>
                                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($examgrade as $index => $value)
                                            <tr class="intro-x">
                                                <td>{{ $examgrade->firstItem() + $index }}</td>
                                                <td>
                                                    <span class="font-medium whitespace-nowrap">{{ $value->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="font-medium whitespace-nowrap">{{ $value->percentage_from }}
                                                        %
                                                        - {{ $value->percentage_to }} %
                                                    </span>
                                                </td>
                                                <td class="table-report__action w-56">
                                                    <div class="flex justify-center gap-1 items-center">

                                                        @include('helper.datatable.edit', [
                                                            'method' => 'edit',
                                                            'id' => $value->id,
                                                        ])

                                                        @include('helper.datatable.delete', [
                                                            'method' => 'deleteconfirm',
                                                            'id' => $value->id,
                                                        ])

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('helper.datatable.pagination', [
                                'pagination' => $examgrade,
                            ])
                        @elseif($searchTerm && $examgrade->isEmpty())
                            @include('helper.datatable.norecordfound')
                        @else
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                            <div class="mx-auto flex flex-row items-center">
                                <div>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter</p>
                                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Grade name, From and To Percentage</span></p>
                                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create grade</p>
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
    </div>

</div>
