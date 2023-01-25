<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Class Emotion Rate</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 gap-6 mt-2">
                <div class="col-span-12 w-full sm:col-span-3 lg:col-span-2 intro-y">
                    <select wire:model="classmasterid" class="form-select w-full">
                        <option value="0">Select Class </option>
                        @foreach ($classmaster as $eachclassmaster)
                            <option value="{{ $eachclassmaster->id }}">
                                {{ $eachclassmaster->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3 lg:col-span-2 intro-y">
                    <input type="date" wire:model="emotiondate" class="w-full" {{$classmasterid ?($acadamicmonthid !='' ? 'disabled' : ''):'disabled'}} >
                </div>
                <div class="text-center">
                    or
                </div>
                <div class="col-span-12 sm:col-span-3 lg:col-span-2 intro-y">
                    <select wire:model="acadamicmonthid" class="form-select w-full" {{$classmasterid ?($emotiondate !='' ? 'disabled' : ''):'disabled'}}>
                        <option value="">Select a Month</option>
                        @foreach ($academicyear->academicyearmonthlist as $key=>$eachmonth)
                            <option value="{{ $eachmonth->id }}">
                                {{$eachmonth->month_string }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 mt-8 justify-around gap-8">
            @if($studentsneedsattention != null && ($acadamicmonthid!='' || $emotiondate!='') )
                <div class="col-span-12 sm:col-span-10 border">
                    <div class="grid grid-cols-12 p-4">
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Students</span><br>
                                <span class="text-xl font-semibold">
                                    {{$student->count()}}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Positivity</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    @if($month)
                                    {{round(array_sum($positivity)/$student->count())}} %
                                    @else
                                    {{round((($studentsneedsattention->sum('excited')+$studentsneedsattention->sum('happy'))/$student->count())*100)}} %
                                    @endif
                                </span>
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Students Needing Help</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    {{$studentneedattentioncount}}
                                </span>
                            </div>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row gap-4 border justify-around bg-gray-200">
                            @if($month)
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Happy - H
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Excited - E 
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Neutral - N
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Feared - F
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Disturbed - D
                                    </span>
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        Not Updated - NU
                                    </span> 
                                </div>
                                <div>
                                    <span class="text-sm text-blue-600">
                                        P% - Postivity%
                                    </span>
                                </div>
                            @else
                            <div>
                                <span class="text-sm text-blue-600">
                                    Happy - {{$studentsneedsattention->sum('happy')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-blue-600">
                                    Excited - {{$studentsneedsattention->sum('excited')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-blue-600">
                                    Neutral - {{$studentsneedsattention->sum('neutral')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-blue-600">
                                    Feared - {{$studentsneedsattention->sum('scared')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-blue-600">
                                    Disturbed - {{$studentsneedsattention->sum('distrubed')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-blue-600">
                                    N/A - {{$studentsneedsattention->sum('notupdated')}}
                                </span> 
                            </div>
                        @endif
                        </div>
                        <div class="col-span-12 mt-5 flex flex-row justify-between mx-2 font-semibold">
                            <div>
                                Class {{$student[0]->classmaster->name}}
                            </div>
                            <div>
                                @if($emotiondate)
                                {{\Carbon\Carbon::parse($this->emotiondate)->format('F d,Y')}}
                                @else
                                {{'Month of ' . \Carbon\Carbon::parse($this->monthstring)->format('F Y')}}
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 mx-6 sm:col-span-12 mt-5 lg:overflow-hidden">
                            @if($month)
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full">
                                    <div class="overflow-hidden">
                                        <table class="table table-report -mt-2">
                                            <thead>
                                                <tr class="intro-x">
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Student
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        E
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        H
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        N
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        F
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        D
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        NU
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        P%
                                                    </th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                                @foreach($studentsneedsattention as $key=>$eachstudent)
                                                    <tr>
                                                        <td>
                                                            {{$eachstudent->name}}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->excited ? $eachstudent->excited : 0 }}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->happy ? $eachstudent->happy : 0 }}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->neutral ? $eachstudent->neutral : 0 }}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->scared ? $eachstudent->scared : 0 }}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->distrubed ? $eachstudent->distrubed : 0 }}
                                                        </td>
                                                        <td>
                                                            @if(sizeof($notupdated)>0)
                                                            {{$notupdated[$key]}}
                                                            @else
                                                            0 
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(sizeof($positivity)>0)
                                                            {{$positivity[$key]}} %
                                                            @else
                                                            0 %
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 sm:col-span-6">
                                        <table class="table border text-center">
                                            <thead>
                                                <tr>
                                                    <th class="bg-primary font-semibold text-white">
                                                        Student
                                                    </th>
                                                    <th class="bg-primary font-semibold text-white">
                                                        Emotion
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($studentsneedsattention as $key=>$eachstudent)
                                                @if($key %2 == 0)
                                                <tr>
                                                        <td>
                                                            {{$eachstudent->name}}
                                                        </td>
                                                        <td>
                                                            @if($eachstudent->excited)
                                                            <span class="text-green-600">Excited</span>
                                                            @elseif($eachstudent->happy)
                                                            <span class="text-green-400">Happy</span>
                                                            @elseif($eachstudent->netural)
                                                            <span class="text-orange-500">Normal</span>
                                                            @elseif($eachstudent->scared)
                                                            <span class="text-purple-500">Feared</span>
                                                            @elseif($eachstudent->disturbed)
                                                            <span class="text-red-500"> Disturbed </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 mt-4 sm:mt-0">
                                        <table class="table border text-center">
                                            <thead>
                                                <tr>
                                                    <th class="bg-primary font-semibold text-white">
                                                        Student
                                                    </th>
                                                    <th class="bg-primary font-semibold text-white">
                                                        Emotion
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($studentsneedsattention as $key=>$eachstudent)
                                                    @if($key %2 != 0)
                                                        <tr>
                                                            <td>
                                                                {{$eachstudent->name}}
                                                            </td>
                                                            <td>
                                                                @if($eachstudent->excited)
                                                                <span class="text-green-600">Excited</span>
                                                                @elseif($eachstudent->happy)
                                                                <span class="text-green-400">Happy</span>
                                                                @elseif($eachstudent->netural)
                                                                <span class="text-orange-500">Normal</span>
                                                                @elseif($eachstudent->scared)
                                                                <span class="text-purple-500">Feared</span>
                                                                @elseif($eachstudent->distrubed)
                                                                <span class="text-red-500"> Disturbed </span>
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                @if(sizeof($studentsneedsattention)%2!=0)
                                                <td>
                                                    <div class="py-2.5">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="py-2.5">

                                                    </div>
                                                </td>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-span-12 mx-auto sm:col-span-2">
                    <button class="btn btn-primary" wire:click="downloadclassemotionratereport">print</button>
                </div>
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class and Date or Month</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view class emotion rate report</p>
                    </div>
                    <div>
                        <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                                alt="ppl">
                    </div>
                </div>
            </div>
            @endif
    </div>
    </div>
</div>
