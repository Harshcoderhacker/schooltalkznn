<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.schoolsettings.helper.schoolsettingsmenu', ['active' => 'weekend'])

        <div class=" col-span-12 xl:col-span-12 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1 ">

                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-1">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Weekdays</h2>
                    </div>

                    <!-- BEGIN: Data List -->
                    @if ($weekend->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            NAME
                                        </th>
                                        <th class="whitespace-nowrap uppercase">
                                            Weekend
                                        </th>
                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($weekend as $index => $value)
                                        <tr class="intro-x">
                                            <td class="">{{ $index + 1 }}</td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->name }}</p>
                                            </td>
                                            <td>
                                                @if ($value->is_holiday)
                                                    <button class="btn btn-success text-white">Yes</button>
                                                @else
                                                    <button class="btn btn-secondary">No</button>
                                                @endif
                                            </td>
                                            <td class="table-report__action w-12 text-center">
                                                <div class="flex justify-center items-center"
                                                    wire:click="confrimweekendopenformModal({{ $value->id }})">
                                                    <div class="form-check form-switch flex flex-col items-start">
                                                        <input class="form-check-input" type="checkbox"
                                                            {{ $isthisholiday[$value->id] ? 'checked' : '' }}>
                                                    </div>
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
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/12 shadow-2xl px-4 py-3 text-center">



                <h1 class="text-2xl"> Are you sure? </h1>
                <div class="text-xl"> Do you really want to Update this record?</div>


                <div class="flex gap-2 mt-4 justify-center">
                    <button wire:click="confrimweekendcloseFormModal({{ $weekendobj->id }})"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-1.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="active({{ $weekendobj->id }})" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    @endif
</div>
