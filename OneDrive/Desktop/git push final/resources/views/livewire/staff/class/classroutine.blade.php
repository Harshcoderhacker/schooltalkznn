@include('staff.class.helper.staffclasssidemenuhelper', [
    'active' => 'routine',
])
<div class="col-span-12 lg:col-span-10 box w-full lg:w-11/12 p-10 intro-y">
    <div class="intro-y col-span-12 overflow-auto">
        <table class="table table-report -mt-2 table-auto">
            <thead class="bg-primary">
                <tr class="intro-x">
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Period
                    </th>
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Timing
                    </th>
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Subject
                        </div>
                    </th>
                    <th class="font-semibold text-white uppercase whitespace-nowrap">
                        <div class="flex">
                            Staff
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classroutine as $index => $eachclassroutine)
                    @php
                        $assingsubject = !$eachclassroutine->timetable->isEmpty() ? $eachclassroutine->timetable[0]->findclassinfo($day) : null;
                    @endphp
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                {{ $eachclassroutine->name }}
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                {{ $eachclassroutine->start_time->format('g:ia') }} -
                                {{ $eachclassroutine->end_time->format('g:ia') }}
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                {{ $assingsubject ? $assingsubject->subject->name : '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                {{ $assingsubject ? $assingsubject->staff->name : '-' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
