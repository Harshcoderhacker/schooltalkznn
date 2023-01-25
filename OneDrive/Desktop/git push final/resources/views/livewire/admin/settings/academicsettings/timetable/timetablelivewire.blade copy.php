<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.academicsettings.helper.academicsettingsmenu', ['active' => 'timetable'])

        <div class="col-span-12 xl:col-span-12">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Search Class</h2>
            </div>
            <div class="p-5 mx-auto sm:mt-5">
                <div class="w-full mx-auto sm:w-11/12 sm:mx-28">
                    <div class="grid grid-cols-12 gap-6 mt-2">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <select wire:model="classmasterid" class="form-select w-full">
                                <option value="0">Select Class </option>
                                @foreach ($classmaster as $eachclassmaster)
                                    <option value="{{ $eachclassmaster->id }}">
                                        Class {{ $eachclassmaster->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <select wire:model="sectionid" class="form-select w-full">
                                <option value="0">Select Section </option>
                                @foreach ($section as $eachsection)
                                    <option value="{{ $eachsection->id }}">
                                        Section {{ $eachsection->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider">
                                    Class Period
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Monday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Tuesday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Wednesday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Thursday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Friday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Saturday
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Sunday
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Period 1 <br>
                                        8:00AM -
                                        9:00AM
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Chemistry
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Ravi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        <i data-feather="plus-circle"></i>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        <i data-feather="plus-circle"></i>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Period 2 <br>
                                        9:00AM -
                                        10:00AM
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Chemistry
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Ravi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Period 3 <br>
                                        8:00AM -
                                        9:00 Am
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Chemistry
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Ravi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        <i data-feather="plus-circle"></i>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        <i data-feather="plus-circle"></i>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Period 4 <br>
                                        8:00AM -
                                        9:00 Am
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Chemistry
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Ravi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Period 1 <br>
                                        8:00AM -
                                        9:00 Am
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Chemistry
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Ravi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Tamil
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Selvi</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span><br>
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">Mr.Mukhilan</span>

                                    <div class="flex felx-row justify-center mt-1 gap-2">
                                        @include('helper.datatable.edit',
                                        ['method' => 'edit',
                                        'id' => 1])

                                        @include('helper.datatable.delete',
                                        ['method' => 'deleteconfirm',
                                        'id' => 1])
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        HOLIDAY
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
