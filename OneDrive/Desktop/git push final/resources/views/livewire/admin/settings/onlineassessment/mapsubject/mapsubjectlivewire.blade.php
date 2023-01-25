<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.onlineassessment.helper.onlineassessmentmenu', ['active' => 'mapsubject'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 ">
        <div class=" col-span-12 xl:col-span-12 ">
            <div class="p-2">
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">
                                    S.No
                                </th>
                                <th class="whitespace-nowrap">
                                    Subject
                                </th>
                                <th class="text-center whitespace-nowrap">
                                    Map Subject
                                </th>
                                <th class="text-center whitespace-nowrap">
                                    Mapped By
                                </th>
                                <th class="text-center whitespace-nowrap">
                                    Mapped At
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjectlist as $index => $eachsubject)
                                <tr class="intro-x">
                                    <td >{{ $index +1 }}</td>
                                    <td>
                                        <span class="font-medium whitespace-nowrap {{$eachsubject->status == true ? 'text-green-600':''}}">{{ $eachsubject->subject->name }}</span>
                                    </td>
                                    <td class="table-report__action w-96">
                                        <div>
                                            @livewire('admin.settings.onlineassessment.mapsubject.mapeachsubjectlivewire',
                                                ['mapsubject' => $eachsubject],
                                                    key($eachsubject->id))
                                        </div>
                                    </td>
                                    <td class="table-report__action">
                                        <span class="font-medium whitespace-nowrap" {{$eachsubject->status == true ? '':'hidden'}}>{{ $eachsubject?->updated_by }}</span>
                                    </td>
                                    <td class="table-report__action">
                                        <span class="font-medium whitespace-nowrap" {{$eachsubject->status == true ? '':'hidden'}}>{{ $eachsubject?->updated_at->format('d-M-Y h:i:s') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
