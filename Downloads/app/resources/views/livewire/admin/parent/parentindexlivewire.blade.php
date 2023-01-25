<div>
    <div class="intro-y chat grid grid-cols-12 gap-5">
        <div class=" col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <h2 class="intro-y text-xl font-medium mt-3">Parent List</h2>
                        <div class="hidden md:block mx-auto text-slate-500"></div>
                        <div class="flex gap-5 w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-slate-500">
                                <input wire:model="searchTerm" type="text" class="form-control w-56 box pr-10"
                                    placeholder="Search...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                            </div>
                            <button wire:click="parentopenformModal()" class="btn btn-primary shadow-md mr-2">Add
                                Parent</button>
                        </div>
                    </div>

                    <!-- BEGIN: Data List -->
                    @if ($aparent->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                PHONE NO

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'phone'])

                                            </div>
                                        </th>
                                        <th class="whitespace-nowrap">NAME</th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aparent as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $aparent->firstItem() + $index }}</td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->phone }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->name }}
                                                </span>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'parent-show',
                                                    'method' => 'show',
                                                    'id' => $value->id])

                                                    @include('helper.datatable.edit',
                                                    ['method' => 'edit',
                                                    'id' => $value->id])

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', ['pagination' => $aparent])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.parent.addparent')
    @include('livewire.admin.parent.parentshow')
</div>
