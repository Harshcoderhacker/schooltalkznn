<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.schoolsettings.helper.schoolsettingsmenu', ['active' => 'emailtemplate'])
        <div class="col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add E-Mail Template</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="createorupdate">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input wire:model="name" type="text"
                            class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Name*" id="emailtemplate_field_focus" autocomplete="off">
                        @error('name') <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($emailtemplateid)
                        <div class="flex mt-3 gap-2 justify-center">
                            <button type="submit" {{ $emailtemplatesubmitbtn ? 'disabled' : '' }}
                                class="btn btn-primary">Update E-Mail Template</button>
                            <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                        </div>
                    @else
                        <button type="submit" {{ $emailtemplatesubmitbtn ? 'disabled' : '' }}
                            class="btn btn-primary w-full mt-3">Add E-Mail Template</button>
                    @endif
                </form>
            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">
                    @include('helper.datatable.header',
                    ['title' => 'E-Mail Template List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($emailtemplate->isNotEmpty())
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
                                                @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'name'])
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emailtemplate as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $emailtemplate->firstItem() + $index }}</td>
                                            <td>
                                                <span class="font-medium whitespace-nowrap">{{ $value->name }}</span>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">

                                                    @include('helper.datatable.show',
                                                    ['modalname' => 'emailtemplate-show',
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
                        @include('helper.datatable.pagination', ['pagination' => $emailtemplate])
                    @elseif($searchTerm && $emailtemplate->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Email Template</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create email template</p>
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
    @include('livewire.admin.settings.schoolsettings.emailtemplate.emailtemplateshow')
</div>
