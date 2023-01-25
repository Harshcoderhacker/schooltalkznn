<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Top Students Leaderboard</h2>
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
                @if( $acadamicmonthid !='')
                <div class="col-span-12 sm:col-span-3 lg:col-span-2 intro-y">
                    <select wire:model="rating" class="form-select w-full">
                        <option value=''>Select a Rating</option>
                        @foreach ($ratinglist as $key=>$eachrating)
                            <option value="{{ $key }}">
                                Top {{$eachrating}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
        <div class="grid grid-cols-12 mt-8 justify-around gap-8">
            @if($acadamicmonthid!='' && $rating !='' && $topleaderboard )
                <div class="col-span-12 sm:col-span-10 border">
                    <div class="grid grid-cols-12 p-4">
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Posts</span><br>
                                <span class="text-xl font-semibold">
                                    {{$topleaderboard->sum('post_count')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Achievements</span><br>
                                <span
                                    class="text-xl font-semibold">{{$topleaderboard->sum('achievement_count')}}</span>
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Polls</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    {{$topleaderboard->sum('poll_count')}}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Stars</span><br>
                                <span
                                    class="text-xl font-semibold">
                                    {{$starcount?->sum('starcount')}}
                                </span>
                            </div>
                        </div>
                        <div class="col-span-12 mt-5 flex flex-row justify-between mx-2 font-semibold">
                            <div>
                                Top Students Leaderboard
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
                                                        Student
                                                    </th>
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
                                                @foreach($topleaderboard as $key=>$eachstudent)
                                                    <tr>
                                                        <td>
                                                            {{$eachstudent->name}}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->classmaster->name}}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->post_count}}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->achievement_count}}
                                                        </td>
                                                        <td>
                                                            {{$eachstudent->poll_count}}
                                                        </td>
                                                        <td>
                                                            {{ $starcount[$key]->starcount }} stars
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
                    <button class="btn btn-primary" wire:click="downloadtopstudentleaderboardreport">Print</button>
                </div>
            @elseif($acadamicmonthid !='' && $rating !='' && sizeof($topleaderboard)==0)
            @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Month and Rating</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view top student leaderboard</p>
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