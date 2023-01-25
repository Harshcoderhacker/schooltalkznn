<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        @include('admin.settings.schoolsettings.helper.schoolsettingsmenu', ['active' => 'academic'])
        <div class="col-span-12 xl:col-span-4 mt-4 mb-12">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Academic Year</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <div>
                            <label for="year" class="form-label font-medium">Year</label>
                            <input wire:model="year" id="year" type="text" class="form-control" placeholder="Year"
                                id="academicyear_field_focus" autocomplete="off">
                            @error('year') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="title" class="form-label  mt-5 font-medium">Title</label>
                            <input wire:model="title" id="title" type="text" class="form-control" placeholder="Title">
                            @error('title') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="start_date" class="form-label mt-5 font-medium">Start Date</label>
                            <input type="date" wire:model="start_date" id="start_date" class="form-control"
                                placeholder="Start Date">
                            @error('start_date') <span
                                    class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="form-label mt-5 font-medium">End Date</label>
                            <input type="date" wire:model="end_date" id="end_date" class="form-control"
                                placeholder="End Date">
                            @error('end_date') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($academicyearid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" class="btn btn-primary">Update Academic Year</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary w-full mt-3">Add Academic Year</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">

                    @include('helper.datatable.header',
                    ['title' => 'Academic Year List',
                    'search' => 'searchTerm'])

                    <!-- BEGIN: Data List -->
                    @if ($academicyear->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                YEAR

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'year'])

                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                TITLE
                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">
                                            START DATE
                                        </th>
                                        <th class="whitespace-nowrap">
                                            END DATE
                                        </th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($academicyear as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $academicyear->firstItem() + $index }}</td>
                                            <td>
                                                <div class="font-medium whitespace-nowrap">{{ $value->year }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-medium whitespace-nowrap">{{ $value->title }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-medium whitespace-nowrap">
                                                    {{ $value->start_date->format('d-M-Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-medium whitespace-nowrap">
                                                    {{ $value->end_date->format('d-M-Y') }}
                                                </div>
                                            </td>
                                            <td class="table-report__action">
                                                <div class="flex justify-center gap-2 items-center">
                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'academicyear-show',
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
                        @include('helper.datatable.pagination', ['pagination' => $academicyear])
                    @elseif($searchTerm && $academicyear->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter and Select</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Year, Title, Start and End Date</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create academic year</p>
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
    @include('livewire.admin.settings.schoolsettings.academicyear.academicyearshow')
</div>
