@include('admin.class.helper.adminclasssidemenuhelper', [
    'active' => 'studentprogress',
])
<div class="col-span-12 sm:col-span-10 box w-full sm:w-11/12 p-10 intro-y">
    <div class="intro-y col-span-12 overflow-auto">
        <table class="table table-report -mt-2 table-auto">
            <thead class="bg-primary">
                <tr class="intro-x">
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Roll Number
                    </th>
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Student Name
                    </th>
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Overall Rank
                        </div>
                    </th>
                    @foreach ($assignsubjectlist as $item)
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                            {{$item->subject->name}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($totalstudents as $key=>$item)
                <tr class="intro-x">
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{$item->roll_no}}
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{$item->name}}
                        </span>
                    </td>
                    <td>
                        @php
                        $eachrank=0;
                            foreach ($this->assignsubjectlist as $item1) {
                                if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() != 0) {
                            $eachrank += round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') / $subjectmark[$key]->where('subject_id', $item1->subject_id)->count());
                            }
                            
                        }
                        @endphp
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{array_search($eachrank,$rank)+1}}
                        </span>
                    </td>
                    @foreach ($assignsubjectlist as $item1)
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            @if($subjectmark[$key]->where('subject_id', $item1->subject_id)->count()!=0)
                             {{round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage')/$subjectmark[$key]->where('subject_id', $item1->subject_id)->count())}} %
                             @else
                             0 %
                             @endif
                             <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    @endforeach
                </tr>
                @endforeach
                {{-- <tr class="intro-x">
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            678
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            Sabari S
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            12
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            1% <i data-feather="arrow-down" class="text-theme-6 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                </tr>
                <tr class="intro-x">
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            980
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            Muhundhan E
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            12
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                </tr>
                <tr class="intro-x">
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            111
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            Vignesh
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            12
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                </tr>
                <tr class="intro-x">
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            128
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            Rahul
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap">
                            12
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                    <td>
                        <span class="text-sm font-medium whitespace-nowrap flex">
                            6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                        </span>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</div>
