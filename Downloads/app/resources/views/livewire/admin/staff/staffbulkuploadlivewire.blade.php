<div>
    <div class=" col-span-12 xl:col-span-12 ">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-3 ">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Staff Bulk Upload</h2>
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
                        <button wire:click="staffbulkuploadsample" class="btn btn-primary">Download Sample
                            File</button>
                    </div>
                </div>
                <div class="intro-y col-span-12 box p-5">
                    <p class="font-medium">1. Your CSV data should be in the format download file. The first line of
                        your
                        CSV file should be the column headers as in the table example. Also, make sure that your file is
                        <br>UTF-8 to avoid unnecessary encoding problems.
                    </p>

                    <p class="font-medium mt-2">2. If the column you are trying to import is date make sure
                        that is formatted
                        in format Y-m-d (2018-06-06).</p>

                    <p class="font-medium mt-2">3. Duplicate "Roll Number" (unique in section) rows will not be
                        imported. Roll
                        No used or not you can get from student report page search on class & section.</p>

                    <p class="font-medium mt-2">4. Duplicate "Guardian email & Guardian Phone" rows will not be
                        Imported.
                        Guardian email & Guardian Phone used or not you can get from student report page search on class
                        &
                        section.</p>

                    <p class="font-medium mt-2">5. For student "Gender" use ID(1-Male, 2-Female,
                        3-Others).</p>

                    <p class="font-medium mt-2">6. For student "Blood Group use Id( 1 = 'A+', 2 = 'A-', 3 = 'B+', 4 =
                        'B-', 5 = 'O+',
                        6 = 'O-', 7 = 'AB+', 8 = 'AB-').</p>

                    <p class="font-medium mt-2">7. For student "Religion" use ID(1 = 'Christianity', 2 = 'Islam', 3 =
                        'Hinduism',
                        4 = 'Sikhism', 5 = 'Buddhism', 6 = 'Protestantism', 7 = 'others',).</p>

                    <p class="font-medium mt-2">8. Please follow this date format(2020-06-15) for the Date of birth
                        & Admission
                        date.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 w-1/2 mx-auto mt-8">
        <div class="col-span-12 sm:col-span-6 intro-y">
            <input wire:model.lazy="file" type="file" id="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            @error('file')
            <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-12 sm:col-span-6 intro-y">
            <button wire:click="importstaffcsv" class="btn btn-primary w-1/2 mx-2 text-center">
                <div wire:loading>
                    @include('helper.loadingicon.loadingicon')
                </div>
                <span wire:loading.remove>Upload</span>
            </button>
        </div>
    </div>
</div>