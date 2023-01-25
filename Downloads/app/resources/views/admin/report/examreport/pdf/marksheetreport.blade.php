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
    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
        <tr>
            <td style="text-align:left; padding: 15px;">
                Exam Name :
                {{ $exam[0]->name }}
            </td>
            <td style="text-align:right; padding: 15px;">
                Academic Year :
                {{ $exam[0]->academicyear->year }}
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
        <tr>
            <td style="text-align:left; padding: 15px;">
                Name : {{ $student->name }}
            </td>
            <td style="text-align:center; padding: 15px;">
                Class {{ $exam[0]->classmaster->name }} - {{ $section_name }}
            </td>
            <td style="text-align:right; padding: 15px;">
                Roll Number : {{ $student->roll_no }}
            </td>
        </tr>
    </table>

    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
        <thead>
            <tr style="border:1px solid black">
                <th style="text-align: center; border:1px solid black">
                    Subject
                </th>
                <th style="text-align: center; border:1px solid black">
                    Total Marks
                </th>
                <th style="text-align: center; border:1px solid black">
                    Mark Obtained
                </th>
                <th style="text-align: center; border:1px solid black">
                    Subject Grade
                </th>
                <th style="text-align: center; border:1px solid black">
                    Remarks
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exam[0]->examsubject as $key => $eachexamsubject)
                <tr class="intro-x">
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ $eachexamsubject->subject->name }}
                        </span>
                    </td>
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ $eachexamsubject->mark }}
                        </span>
                    </td>
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ $examsubjectmark[$key]->mark }}
                        </span>
                    </td>
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium text-center text-theme-11">
                            @foreach ($grade as $eachgrade)
                                @if ($eachgrade->percentage_from <= $examsubjectmark[$key]->subjectmark_percentage && $eachgrade->percentage_to > $examsubjectmark[$key]->subjectmark_percentage)
                                    {{ $eachgrade->name }}
                                @elseif($examsubjectmark[$key]->subjectmark_percentage == 100 && $eachgrade->percentage_to == 100)
                                    {{ $eachgrade->name }}
                                @endif
                            @endforeach
                        </span>
                    </td>
                    <td style="text-align: center;
                             border:1px solid black">
                        <span class="text-sm font-medium text-center text-theme-9">
                            {{ $examsubjectmark[$key]?->remarks }}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr class="intro-x">
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        All Subjects
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ $exam[0]->examsubject->sum('mark') }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        {{ $examsubjectmark->sum('mark') }}
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium text-center text-theme-11">
                        @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                            $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                            @foreach ($grade as $eachgrade)
                                @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                                    {{ $eachgrade->name }}
                                @elseif(($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                    {{ $eachgrade->name }}
                                @endif
                            @endforeach
                        @else
                            F
                        @endif
                    </span>
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    <span class="text-sm font-medium whitespace-nowrap">
                        @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                            $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                            Pass
                        @else
                            Fail
                        @endif
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <table style="border-collapse: collapse;
                    border-spacing: 0;
                    margin-top:16px;
                    width: 100%;
                    border: 1px solid black">
        <tr>
            <th>
                <h3>Overall Percentage</h3>
            </th>
            <th>
                <h3>Rank</h3>
            </th>
            <th>
                <h3>Grade</h3>
            </th>
        </tr>
        <tr>
            <td style="text-align:center; padding:4px; ">
                {{ round(($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100) }}
                %
            </td>
            <td style="text-align:center; padding:4px;">
                @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                    $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                    {{ array_search($student->id, array_keys($total_mark)) + 1 }} /
                    {{ sizeof($total_mark) }}
                @else
                    -
                @endif
            </td>
            <td style="text-align:center; padding:4px;">
                @if (sizeof($examsubjectmark->where('exam_id', $exam[0]->id)) ==
                    $examsubjectmark->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                    @foreach ($grade as $eachgrade)
                        @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                            {{ $eachgrade->name }}
                        @elseif(($examsubjectmark->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                            {{ $eachgrade->name }}
                        @endif
                    @endforeach
                @else
                    F
                @endif
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
