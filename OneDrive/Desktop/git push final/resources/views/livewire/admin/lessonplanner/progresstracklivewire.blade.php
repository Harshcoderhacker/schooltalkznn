<div>
    <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select wire:model="classmasterid" class="form-select w-full mt-5">
                <option value="0">Select Class </option>
                @foreach ($classmasterlist as $eachclassmasterlist)
                    <option value="{{ $eachclassmasterlist->id }}">
                        {{ $eachclassmasterlist->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select wire:model="sectionid" class="form-select w-full mt-5">
                <option value="0">Select Section </option>
                @foreach ($sectionlist as $eachsectionlist)
                    <option value="{{ $eachsectionlist->id }}">
                        {{ $eachsectionlist->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($assignsubject->isNotEmpty())
        <div class="flex flex-row w-full justify-end mt-5 gap-6">
            <button wire:click="downloadexportprogress" class="btn btn-primary w-32 ">Export Progress</button>
        </div>
        <div class="flex flex-col mt-2 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden  sm:rounded-lg">
                        <table class="w-full mt-2 table-fixed">
                            <thead class="text-center">
                                <tr>
                                    <td></td>
                                    @foreach ($month as $key => $eachmonth)
                                        <td class="pb-2">{{ $eachmonth }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignsubject as $eachassignsubject)
                                    <tr>
                                        <td class="w-24 p-5">{{ $eachassignsubject->subject->name }}</td>
                                        @foreach ($month as $key => $eachmonth)
                                            @php
                                                $lesson = App\Models\Admin\Lessonplanner\Lesson::where('classmaster_id', $classmasterid)
                                                    ->where('section_id', $sectionid)
                                                    ->where('subject_id', $eachassignsubject->subject->id)
                                                    ->whereMonth('start_date', $key)
                                                    ->get();
                                            @endphp
                                            <td class="bg-white border border-slate-300">
                                                @foreach ($lesson as $eachlesson)
                                                    @php
                                                        if ($eachlesson->is_completed) {
                                                            $status_color = '#4CD137';
                                                        } elseif ($eachlesson->due_date < Carbon\Carbon::now()) {
                                                            $status_color = '#E84118';
                                                        } else {
                                                            $status_color = '#E67E22';
                                                        }
                                                        
                                                    @endphp

                                                    @if ($key % 2 == 0)
                                                        <div class="text-white p-1 my-1 text-center rounded"
                                                            style="background-color: {{ $status_color }}">
                                                            {{ $eachlesson->name }}
                                                        </div>
                                                    @else
                                                        <br><br>
                                                        <div class="text-white p-1 my-1 text-center rounded"
                                                            style="background-color: {{ $status_color }}">
                                                            {{ $eachlesson->name }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('helper.datatable.norecordfound')
    @endif
</div>
