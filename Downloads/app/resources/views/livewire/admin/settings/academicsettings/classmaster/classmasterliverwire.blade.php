<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.academicsettings.helper.academicsettingsmenu', ['active' => 'class'])
        <div class="col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Class</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="confrimclassopenformModal">


                    <div class="relative text-gray-700 dark:text-gray-300 mb-3">
                        <input wire:model="name" type="text"
                            class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Name*" id="classmaster_field_focus" autocomplete="off">
                        @error('name') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>


                    @if ($classmasterid)
                        @foreach ($section as $key => $eachsection)
                            @if ($sectionid->contains($eachsection->id))

                                <div class="flex items-center p-1 text-green-600">
                                    <div class="form-check form-switch flex flex-col items-start">
                                        <input id="post-form-5" class="form-check-input" type="checkbox"
                                            wire:model="sectionchecked" disabled>
                                    </div>
                                    <div class="ml-5">Section {{ $eachsection->name }}</div>
                                </div>

                            @else
                                <div class="flex items-center p-1">
                                    <div class="form-check form-switch flex flex-col items-start">
                                        <input id="post-form-5" class="form-check-input" type="checkbox"
                                            wire:model.defer="selectedSection" value="{{ $eachsection->id }}">
                                    </div>
                                    <div class="ml-5">Section {{ $eachsection->name }}</div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        @foreach ($section as $key => $eachsection)
                            <div class="flex items-center p-1">
                                <div class="form-check form-switch flex flex-col items-start">
                                    <input id="post-form-5" class="form-check-input" type="checkbox"
                                        wire:model.defer="selectedSection" value="{{ $eachsection->id }}">
                                </div>
                                <div class=" ml-5">Section {{ $eachsection->name }}
                                </div>
                            </div>
                        @endforeach
                    @endif



                    @if ($classmasterid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" class="btn btn-primary">Update Class</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary w-full mt-3">Add Class</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header',
                    ['title' => 'Class List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($classmaster->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap w-5">
                                            S.NO
                                        </th>
                                        <th class="text-center w-1/4 whitespace-nowrap">
                                            <div class="flex">
                                                CLASS NAME

                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'name'])

                                            </div>
                                        </th>

                                        <th class="whitespace-nowrap w-3/4">
                                            SECTION
                                        </th>


                                        <th class="text-center w-1/4 whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classmaster as $index => $value)
                                        <tr class="intro-x">
                                            <td>{{ $classmaster->firstItem() + $index }}</td>
                                            <td>
                                                <span class="font-medium whitespace-wrap">{{ $value->name }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="font-medium whitespace-wrap">{{ implode(', ', $value->section->pluck('name')->toArray()) }}</span>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'classmaster-show',
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
                        @include('helper.datatable.pagination', ['pagination' => $classmaster])
                    @elseif($searchTerm && $classmaster->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter and Select</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class Name and Section</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create class</p>
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





    @if ($isModalFormOpen)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl px-4 py-3 text-center">



                <h1 class="text-2xl"> Are you sure? </h1>
                <div class="text-xl"> Do you really want to Update this record?</div>
                <div class="text-lg"> This process cannot be Revoke.</div>


                <div class="flex gap-2 mt-4 justify-center">
                    <button type="button" wire:click="confrimclasscloseFormModal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-1.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="createorupdate" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    @endif








    @include('livewire.admin.settings.academicsettings.classmaster.classmastershow')
</div>
