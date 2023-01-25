<div class="col-span-12 lg:col-span-8 flex lg:block flex-col-reverse">
    @if ($is_chat == false)
    <div>
        <span class="flex flex-row-reverse">
            <button class="btn btn-primary" wire:click="downloadevaluationreport">Evaluation Report</button>
        </span>

        <div class="grid grid-cols-12 gap-1 mt-5">
            <div class="intro-y col-span-12 overflow-auto">
                <table class="table table-report -mt-2 table-auto">
                    <thead class="bg-primary">
                        <tr class="intro-x">
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Admission No.
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Student Name
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Marks
                                </div>
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Homework Status
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Submissions
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Comments
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($homework->homeworklist as $index => $eachhomeworklist)
                        @livewire('admin.homework.homeworklisttablelivewire', ['eachhomeworklist' =>
                        $eachhomeworklist, 'platform' =>$platform],
                        key($loop->index))
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="intro-y">
            @if ($platform == 'admin')
            <a type="button" href="{{ route('adminhomework') }}"
                class="float-right btn btn-primary rouded-full mt-5">Save</a>
            @elseif($platform == 'staff')
            <a type="button" href="{{ route('staffhomework') }}"
                class="float-right btn btn-primary rouded-full mt-5">Save</a>
            @endif
        </div>
    </div>
    @else
    <div>
        <div class="flex flex-row-reverse">
            <button wire:click="back" class="btn btn-primary">back</button>
        </div>
        @livewire('admin.homework.homeworkcomments.adminhomeworkcommentlivewire',
        ['homeworklist' => $homeworklist_id,'platform' =>$platform])
    </div>
    @endif


</div>