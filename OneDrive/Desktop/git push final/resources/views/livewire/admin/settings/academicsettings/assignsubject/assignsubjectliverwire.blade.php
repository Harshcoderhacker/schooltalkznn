<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        @include('admin.settings.academicsettings.helper.academicsettingsmenu', ['active' => 'assignsubject'])
        <div class="col-span-12 xl:col-span-4 mt-4">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Assign Subject</h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5">
                <form>
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <select wire:model="classmasterid" class="form-select w-full">
                            <option value="0">Select Class </option>
                            @foreach ($classmaster as $eachclassmaster)
                                <option value="{{ $eachclassmaster->id }}">
                                    {{ $eachclassmaster->name }}
                                </option>
                            @endforeach
                        </select>

                        <select wire:model="sectionid" class="form-select w-full mt-5">
                            <option value="0">Select Section </option>
                            @foreach ($section as $eachsection)
                                <option value="{{ $eachsection->id }}">
                                    {{ $eachsection->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class=" col-span-12 xl:col-span-8 ">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Subjects</h2>
                    </div>
                    @if ($classmasterid && $sectionid)
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex">
                                                SUBJECT NAME

                                                {{-- @include('helper.datatable.sorting',
                                                ['method' => 'sortBy',
                                                'value' => 'name']) --}}

                                            </div>
                                        </th>

                                        <th class="whitespace-nowrap">
                                            TEACHER
                                        </th>


                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignsubject as $index => $value)
                                        <tr class="intro-x ">
                                            <td class={{ $value->active ? 'text-green-600' : '' }}>
                                                {{ $index + 1 }}</td>
                                            <td class={{ $value->active ? 'text-green-600' : '' }}>
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->subject->name }}</span>
                                            </td>
                                            <td class={{ $value->active ? 'text-green-600' : '' }}>
                                                <span class="font-medium whitespace-nowrap">
                                                    {{ $value->staff?->name }}
                                                </span>
                                                @if ($value->is_classteacher)
                                                    <small>
                                                        <p> (Class Teacher) </p>
                                                    </small>
                                                @endif
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
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif($classmasterid && $sectionid && $assignsubject->isEmpty())
                        @include('helper.datatable.norecordfound')
                    @else
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                        <div class="mx-auto flex flex-row items-center">
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class and Section</span></p>
                                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to assign a subject</p>
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
    @include('livewire.admin.settings.academicsettings.assignsubject.assignsubjectshow')
    @include('livewire.admin.settings.academicsettings.assignsubject.assignsubjectedit')
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#staffselect2').select2();
            $('#staffselect2').on('change', function(e) {
                var data = $('#staffselect2').select2("val");
                @this.set('staffid', data);
            });
        });

    </script>
@endpush
