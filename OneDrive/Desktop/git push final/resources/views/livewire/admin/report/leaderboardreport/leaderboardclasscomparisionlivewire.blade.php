<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Leaderboard Class Comparision</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 gap-6 mt-2">
                <div class="col-span-12 sm:col-span-3 lg:col-span-2 intro-y">
                    <select wire:model="acadamicmonthid" class="form-select w-full">
                        <option value="">Select a Month</option>
                        <option value=0>Overall</option>
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
            @if($acadamicmonthid!='')
                <div class="col-span-12 sm:col-span-10 border">
                    <div class="grid grid-cols-12 p-4">
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Posts</span><br>
                                <span class="text-xl font-semibold">
                                    {{array_sum($postcount)}}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Achievements</span><br>
                                <span
                                    class="text-xl font-semibold">{{array_sum($achievementcount)}}</span>
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Polls</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    {{array_sum($pollcount)}}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Stars</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    {{array_sum($starcount)}}
                                </span>
                            </div>
                        </div>
                        <div class="col-span-12 mt-5 flex flex-row justify-between mx-2 font-semibold">
                            <div>
                                Leaderboard Class Comparision
                            </div>
                            <div>
                                @if($month!=13)
                                Month of {{$month_string}}
                                @else
                                Year {{$academicyear->year}}
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 mx-6 sm:col-span-12 mt-5 lg:overflow-hidden">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full">
                                    <div class="overflow-hidden">
                                        <table class="table table-report -mt-2">
                                            <thead>
                                                <tr class="intro-x">
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Class
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Posts
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Achievements
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Polls
                                                    </th>
                                                    <th class="font-semibold uppercase whitespace-nowrap">
                                                        Stars
                                                    </th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                            @foreach ($classmaster as $key=>$eachclassmaster)
                                            <tr>
                                                <td>
                                                    Class {{$eachclassmaster->name}}
                                                </td>
                                                <td>
                                                    {{$postcount[$key]}}
                                                </td>
                                                <td>
                                                    {{$achievementcount[$key]}}
                                                </td>
                                                <td>
                                                    {{$pollcount[$key]}}
                                                </td>
                                                <td>
                                                    {{$starcount[$key]}}
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
                </div>
                <div class="col-span-12 mx-auto sm:col-span-2">
                    <button class="btn btn-primary" wire:click="downloadleaderboardclasscomparisionreport">print</button>
                </div>
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Month</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view leaderboard class comparision</p>
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
