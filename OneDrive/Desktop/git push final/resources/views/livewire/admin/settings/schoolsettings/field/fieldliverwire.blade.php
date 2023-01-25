<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.schoolsettings.helper.schoolsettingsmenu', ['active' => 'field'])
        <div class="col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Field</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <div>
                            <label for="field_for" class="form-label font-medium">Field For</label>
                            <input wire:model="field_for" id="field_for" type="text" class="form-control"
                                placeholder="Field For" id="holiday_field_focus" autocomplete="off">
                            @error('field_for') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="field_type" class="form-label mt-5 font-medium">Field Type</label>
                            <input type="text" wire:model="field_type" id="field_type" class="form-control"
                                placeholder="Field Type">
                            @error('field_type') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="form-label mt-5 font-medium">Field Name</label>
                            <input type="text" wire:model="name" id="name" class="form-control"
                                placeholder="Field Name">
                            @error('name') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($fieldid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" class="btn btn-primary">Update Field</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary w-full mt-3">Add Field</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">
                    @include('helper.datatable.header',
                    ['title' => 'Field List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($field->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex uppercase">
                                                Field NAME

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'name'])

                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap uppercase">
                                            Field Type
                                        </th>
                                        <th class="whitespace-nowrap uppercase">
                                            Field For
                                        </th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($field as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $field->firstItem() + $index }}</td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->name }}</p>
                                            </td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->field_type }}</p>
                                            </td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->field_for }}</p>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'field-show',
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
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                            {{ $field->links() }}
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
                                <select wire:click="updatepagination" wire:model="paginationlength"
                                    class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 mx-0">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                    @elseif($searchTerm && $field->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Field Name, For and Type</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create field</p>
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
    @include('livewire.admin.settings.schoolsettings.field.fieldshow')
</div>
