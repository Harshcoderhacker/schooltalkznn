<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <tr>
        <td colspan="2" style="text-align:center">
            <h1>{{ App::make('generalsetting')->schoolname }}</h1>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center">
            <p>{{ App::make('generalsetting')->address }}</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:left; padding: 15px;">
            {{ App::make('generalsetting')->phone }}
        </td>
        <td style="text-align:right; padding: 15px;">
            {{ App::make('generalsetting')->email }}
        </td>
    </tr>
</table>
<div style="text-align:center; padding: 16px;">
    <h3>
        Class {{ $exam[0]->classmaster->name }} - {{ $section_name }}
    </h3>
</div>
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <thead>
        <tr class="intro-x">
            <th style="text-align: center;
                             border:1px solid black">
                Subject
            </th>
            @foreach ($exam[0]->examsubject as $key => $eachexamsubject)
                <th style="text-align: center;
                             border:1px solid black">
                    {{ $eachexamsubject->subject->name }}
                </th>
            @endforeach
            <th style="text-align: center;
                             border:1px solid black">
                Total
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Average
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Grade
            </th>
            <th style="text-align: center;
                             border:1px solid black">
                Rank
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($examsubjectmark as $key => $eachexamsubjectmark)
            <tr class="intro-x">
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ $eachexamsubjectmark->student->name }}
                    </span>
                </td>
                @foreach ($eachexamsubjectmark->examstudentsubjectlist as $key => $eachsubjectmark)
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ round(($eachsubjectmark->mark / $exam[0]->examsubject[$key]->mark) * 100) }}
                        </span>
                    </td>
                @endforeach
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) *$exam[0]->examsubject->sum('mark')) * sizeof($exam[0]->examsubject) }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100) }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    @if (sizeof($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)) ==
                        $eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                        @foreach ($grade as $eachgrade)
                            @if ($eachgrade->percentage_from <= ($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                                <span
                                    class="text-sm font-medium whitespace-nowrap text-orange-500">{{ $eachgrade->name }}</span>
                            @elseif(($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                <span
                                    class="text-sm font-medium whitespace-nowrap text-orange-500">{{ $eachgrade->name }}</span>
                            @endif
                        @endforeach
                    @else
                        <span class="text-sm font-medium whitespace-nowrap text-orange-500">F</span>
                    @endif
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    @if (sizeof($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)) ==
                        $eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                        <span
                            class="text-green-600">{{ array_search($eachexamsubjectmark->student_id, array_keys($total_mark)) + 1 }}</span>
                    @else
                        <span class="text-xl text-red-600">-</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <tr>
        <th>
            <h3>Exam Attendance</h3>
        </th>
        <th>
            <h3>Class Average</h3>
        </th>
        <th>
            <h3>Pass Percentage</h3>
        </th>
    </tr>
    <tr>
        <td style="text-align:center; padding:4px; ">
            {{ $examattendance }} %
        </td>
        <td style="text-align:center; padding:4px;">
            {{ $avg }}
        </td>
        <td style="text-align:center; padding:4px;">
            {{ round((sizeof($total_mark) / sizeof($examsubjectmark)) * 100) }} %
        </td>
    </tr>
</table>
<table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
    <tr>
        @foreach ($grade as $eachgrade)
            <td style="text-align:center; padding: 15px;">
                {{ $eachgrade->percentage_from }} % - {{ $eachgrade->percentage_to }} %
                {{ $eachgrade->name }}
            </td>
        @endforeach
    </tr>
</table>
