<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.settings.onlineassessment.helper.onlineassessmentmenu', ['active' => 'mapclass'])
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 ">
        <div class=" col-span-12 xl:col-span-12">
            <div class="p-2">
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">
                                    S.No
                                </th>
                                <th class="whitespace-nowrap">
                                    Class
                                </th>
                                <th class="text-center whitespace-nowrap">
                                    Map Class
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
                            @foreach ($classlist as $index => $eachclass)
                                <tr class="intro-x">
                                    <td class="">{{ $index +1 }}</td>
                                    <td>
                                        <span class="font-medium whitespace-nowrap {{$eachclass->status == true ? 'text-green-600':''}}">{{ $eachclass->classmaster->name }}</span>
                                    </td>
                                    <td class="table-report__action w-96">
                                        <div>
                                            @livewire('admin.settings.onlineassessment.mapclass.mapeachclasslivewire',
                                                ['mapclass' => $eachclass],
                                                    key($eachclass->id))
                                        </div>
                                    </td>
                                    <td class="table-report__action">
                                        <span class="font-medium whitespace-nowrap"{{$eachclass->status == true ? '':'hidden'}}>{{ $eachclass?->updated_by }}</span>
                                    </td>
                                    <td class="table-report__action">
                                        <span class="font-medium whitespace-nowrap"{{$eachclass->status == true ? '':'hidden'}}>{{ $eachclass?->updated_at->format('d-M-Y h:i:s') }}</span>
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
