<div>
    <div id="leaves" class="tab-pane" role="tabpanel" aria-labelledby="leaves-tab">
        <div class="box p-2 mt-5">
            <div class="box grid grid-cols-12 intro-y mt-2 gap-4 w-full sm:w-11/12 mx-auto">
                <table class="col-span-12 sm:col-span-6 w-full sm:w-9/12 mx-auto table mt-3 rounded-lg">
                    <tbody class="divide-y-2">
                        @php
                        $count =1;
                        @endphp
                        @if($staff->staffattendancelist)
                        @foreach($staff->staffattendancelist as $key=>$eachday)
                        @if($eachday->where('absent',true))
                        <tr class="intro-x">
                            <td>{{ $count}}</td>
                            <td>{{ Carbon\Carbon::parse($eachday->staffattendance->attendance_date)->format('d-m-Y')
                                }}
                            </td>
                            <td class="text-red-600">Absent</td>
                        </tr>
                        @php
                        $count +=1;
                        @endphp
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
