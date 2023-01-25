<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        @include(
            'admin.settings.schoolsettings.helper.schoolsettingsmenu',
            ['active' => 'loginpermission']
        )
        <div class="col-span-12 xl:col-span-4 mt-4 mb-12">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Select Class</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form wire:submit.prevent="searchrole">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <div>
                            <label for="name" class="form-label font-medium">User</label>
                            <select wire:model="role" class="form-select w-full">
                                <option>Select A Role</option>
                                <option value="1">Student</option>
                                <option value="2">Staff</option>
                            </select>
                            @error('role')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        @if($role ==2)
                        <div>
                            <label for="name" class="form-label mt-5 font-medium">Department</label>
                            <select wire:model="department_id" class="form-select w-full">
                                <option>Select A Department</option>
                                @foreach ($department as $key => $value)
                                    <option value={{ $value->id }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        @else
                        <div>
                            <label for="class_id" class="form-label mt-5 font-medium">Class</label>
                            <select wire:model="class_id" class="form-select w-full">
                                <option>Select A Class</option>
                                @foreach ($class as $key => $value)
                                    <option value={{ $value->id }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="section_id" class="form-label mt-5 font-medium">Section</label>
                            <select wire:model="section_id" class="form-select w-full">
                                <option>Select A Section</option>
                                @foreach ($section as $key => $value)
                                    <option value={{ $value->id }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-full mt-3">Search</button>
                </form>
            </div>
        </div>
        <div class="col-span-12 xl:col-span-8 ">
            <div class="p-2">
                @if ($student)
                    <div class="grid grid-cols-12 gap-1">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Student List
                                ({{ $student->count() }}) - Class {{ $classmaster_name }},
                                Section {{ $section_name }}</h2>
                        </div>
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead class="uppercase">
                                    <tr>
                                        <th class="text-center whitespace-nowrap uppercase">
                                            <div class="flex">
                                                Roll Number
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap uppercase">
                                            <div class="flex">
                                                Name
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">Permissions</th>
                                        <th class="text-center whitespace-nowrap">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $index => $value)
                                        <tr class="intro-x">
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->roll_no }}</p>
                                            </td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex justify-center">
                                                    <div class="form-check form-switch flex flex-col items-start">
                                                        <input id="post-form-5" class="form-check-input" type="checkbox"
                                                            {{ $value->active ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">
                                                    <button wire:click="alertpopup({{ $value->id }})"
                                                        class="flex items-center text-red-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-key">
                                                            <path
                                                                d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif($staff)
                    <div class="grid grid-cols-12 gap-1">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead class="uppercase">
                                    <tr>
                                        <th class="text-center whitespace-nowrap uppercase">
                                            <div class="flex">
                                                Staff Role Id
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap uppercase">
                                            <div class="flex">
                                                Name
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">Permissions</th>
                                        <th class="text-center whitespace-nowrap">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $index => $value)
                                        <tr class="intro-x">
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->staff_roll_id }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="font-medium whitespace-nowrap">{{ $value->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex justify-center">
                                                    <div class="form-check form-switch flex flex-col items-start">
                                                        <input id="post-form-5" class="form-check-input" type="checkbox"
                                                            {{ $value->active ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center gap-2 items-center">
                                                    <button wire:click="alertpopup({{ $value->id }})"
                                                        class="flex items-center text-red-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-key">
                                                            <path
                                                                d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                 <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                    <div class="mx-auto flex flex-row items-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                            <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">User and Respective fields</span></p>
                            <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view list</p>
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
    @if ($alertmodal)
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
                    <button type="button" wire:click="closealertpopup"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-1.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="changepassword({{ $studentorstaffid }})"
                        class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    @endif
</div>
