<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include(
        'admin.settings.academicsettings.helper.academicsettingsmenu',
        ['active' => 'classroutine']
        )
        <div class="col-span-12 sm:col-span-5 lg:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Class Routine</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <div>
                            <label for="name" class="form-label font-medium">Class Period</label>
                            <input wire:model.lazy="name" id="name" type="text" class="form-control"
                                placeholder="Class Period" id="classroutine_field_focus" autocomplete="off">
                            @error('name')
                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="start_time" class="form-label mt-5 font-medium">Start Time</label>
                            <input type="time" wire:model.lazy="start_time" id="start_time" class="form-control"
                                placeholder="Start Time">
                            @error('start_time')
                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="end_time" class="form-label mt-5 font-medium">End time</label>
                            <input type="time" wire:model.lazy="end_time" id="end_time" class="form-control"
                                placeholder="End time">
                            @error('end_time')
                            <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex items-center p-1 mt-4">
                            <div class="form-check form-switch flex flex-col items-start">
                                <input id="post-form-5" class="form-check-input" type="checkbox"
                                    wire:model.lazy="is_break">
                            </div>
                            <div class="ml-2 form-label font-medium mt-2">Is Break ?</div>
                        </div>
                    </div>
                    @if ($classroutineid)
                    <div class="flex mt-3 gap-2 justify-center">
                        <button type="submit" class="btn btn-primary">Update Class Routine</button>
                        <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                    </div>
                    @else
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <div wire:loading>
                                @include('helper.loadingicon.loadingicon')
                            </div>
                            <span wire:loading.remove>Add Class Routine</span>
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 sm:col-span-7 lg:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header', [
                    'title' => 'Class Routine List',
                    'search' => 'searchTerm',
                    ])
                    <!-- BEGIN: Data List -->
                    @if ($classroutine->isNotEmpty())
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        S.NO
                                    </th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            NAME

                                            @include('helper.datatable.sorting', [
                                            'method' => 'sortBy',
                                            'value' => 'name',
                                            ])

                                        </div>
                                    </th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            Start Time
                                        </div>
                                    </th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            End Time
                                        </div>
                                    </th>
                                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classroutine as $index => $value)
                                <tr class="intro-x">
                                    <td>{{ $classroutine->firstItem() + $index }}</td>
                                    <td>
                                        <span class="font-medium whitespace-nowrap">{{ $value->name }}</span>
                                    </td>
                                    <td>
                                        <a class="font-medium whitespace-nowrap">
                                            {{ $value->start_time->format('g:i A') }}
                                        </a>

                                    </td>
                                    <td>
                                        <a class="font-medium whitespace-nowrap">
                                            {{ $value->end_time->format('g:i A') }}
                                        </a>
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center gap-2 items-center">

                                            @include('helper.datatable.show', [
                                            'modalname' => 'classroutine-show',
                                            'method' => 'show',
                                            'id' => $value->id,
                                            ])

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
                    'pagination' => $classroutine,
                    ])
                    @elseif($classroutine->isEmpty() && $searchTerm)
                    @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class routine name, Start and End Time</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create a class routine</p>
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
    @include(
    'livewire.admin.settings.academicsettings.classroutine.classroutineshow'
    )
</div>