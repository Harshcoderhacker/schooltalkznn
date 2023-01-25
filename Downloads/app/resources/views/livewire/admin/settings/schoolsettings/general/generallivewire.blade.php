<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        @include('admin.settings.schoolsettings.helper.schoolsettingsmenu', ['active' => 'generalsetting'])
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5 mb-12">
        <div class="col-span-12 xl:col-span-4 mt-5">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Logo</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="uploadlogo">
                    <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">

                        @if ($logo)
                            <img class="rounded-md" src="{{ $logo->temporaryUrl() }}">
                        @elseif ($existinglogo)
                            <img class="rounded-md" src="{{ url('storage/' . $existinglogo) }}">
                        @else
                            <img class="rounded-md h-36 mx-auto" alt="edfish"
                                src="{{ asset('image/dummy/200x200.jpg') }}">
                        @endif

                        @error('logo')
                            <span class="text-primary-3">{{ $message }}</span>
                        @enderror

                        <div class="mx-auto cursor-pointer relative mt-5">
                            <button type="submit" class="btn btn-primary w-full">Change Logo</button>
                            <input type="file" wire:model="logo" class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                        @if ($logo?->temporaryUrl())
                            <button type="submit" class="btn btn-success w-full mt-2">Save</button>
                        @endif
                    </div>
                </form>
            </div>
            <div class="intro-y block sm:flex items-center h-10 mt-4">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Favicon</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-8 text-center">

                <form wire:submit.prevent="uploadfavicon">
                    <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">

                        @if ($favicon)
                            <img class="rounded-md" src="{{ $favicon->temporaryUrl() }}">
                        @elseif ($existingfavicon)
                            <img class="rounded-md" src="{{ url('storage/' . $existingfavicon) }}">
                        @else
                            <img class="rounded-md h-36 mx-auto" alt="edfish"
                                src="{{ asset('image/dummy/200x200.jpg') }}">
                        @endif

                        @error('favicon')
                            <span class="text-primary-3">{{ $message }}</span>
                        @enderror

                        <div class="mx-auto cursor-pointer relative mt-5">
                            <button type="submit" class="btn btn-primary w-full">Change Favicon</button>
                            <input type="file" wire:model="favicon"
                                class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                        @if ($favicon?->temporaryUrl())
                            <button type="submit" class="btn btn-success w-full mt-2">Save</button>
                        @endif
                    </div>
                </form>

            </div>
        </div>
        <div class=" col-span-12 xl:col-span-8">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">General Information</h2>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
                    <div class="w-40 relative text-gray-700 dark:text-gray-300">
                        <a wire:click="edit" class="btn btn-primary w-full mt-3">Edit</a>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <tbody>
                        <tr class="intro-x hover:bg-primary4">
                            <td class=" py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                School Name</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->schoolname }}
                            </td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                App Title</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->apptitle }}
                            </td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                Address</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->address }}
                            </td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                Phone Number
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->phone }} </td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                E-Mail Address
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->email }}</td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                School Code</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->code }}</td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                Academic Year
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ $generalsettings->academicyear }}
                            </td>
                        </tr>
                        <tr class="intro-x hover:bg-primary4">
                            <td class="py-4 px-6 border-b border-grey-light font-semibold dark:text-white">
                                Language</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $generalsettings->language }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    @if ($isModalFormOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-6/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Update General Settings
                    </h3>
                    <button wire:click="generalsettingscloseFormModalPopover"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="updategeneralsetting">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label for="school_name_id" class="form-label font-medium">School Name</label>
                                <input autocomplete="off" wire:model.lazy="schoolname" name="school_name"
                                    id="school_name_id" type="text" class="form-control" placeholder="School Name">
                                @error('schoolname')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="app_title_id" class="form-label font-medium">App Title</label>
                                <input autocomplete="off" wire:model.lazy="apptitle" name="app_title" id="app_title_id"
                                    type="text" class="form-control" placeholder="App Title">
                                @error('apptitle')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="address_id" class="form-label font-medium">Address</label>
                                <input autocomplete="off" wire:model.lazy="address" name="address" id="address_id"
                                    type="text" class="form-control" placeholder="Project Id">
                                @error('address')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="phone_no_id" class="form-label font-medium">Phone Number</label>
                                <input autocomplete="off" wire:model.lazy="phone" name="phone_no" id="phone_no_id"
                                    type="text" class="form-control" placeholder="Phone Number">
                                @error('phone')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="email_address_id" class="form-label font-medium">E-Mail Address</label>
                                <input autocomplete="off" wire:model.lazy="email" name="email_address"
                                    id="email_address_id" type="text" class="form-control"
                                    placeholder="E-Mail Address">
                                @error('email')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="school_code_id" class="form-label font-medium">School Code</label>
                                <input autocomplete="off" wire:model.lazy="code" name="school_code" id="school_code_id"
                                    type="text" class="form-control" placeholder="School Code">
                                @error('code')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="academic_year_id" class="form-label font-medium">Academic Year</label>
                                <input autocomplete="off" wire:model.lazy="academicyear" name="academic_year"
                                    id="academic_year_id" type="text" class="form-control"
                                    placeholder="Academic Year">
                                @error('academicyear')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="language_id" class="form-label font-medium">Language</label>
                                <input autocomplete="off" wire:model.lazy="language" name="language" id="language_id"
                                    type="text" class="form-control" placeholder="Language">
                                @error('language')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="generalsettingscloseFormModalPopover"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
