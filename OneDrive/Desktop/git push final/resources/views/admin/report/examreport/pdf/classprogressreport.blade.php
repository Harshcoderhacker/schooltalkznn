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

            </th>
            @foreach ($exam->unique('subject_id') as $eachexam)
                @foreach ($eachexam->examsubject as $eachsubject)
                    <th colspan={{ sizeof($exam) }} class="font-semibold uppercase text-center whitespace-nowrap">
                        {{ $eachsubject->subject->name }}
                    </th>
                @endforeach
            @endforeach
            <th colspan="3" style="text-align: center;
            border:1px solid black">

            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="intro-x">
            <td style="text-align: center;
                             border:1px solid black">
                Student Name
            </td>
            @php
                $count = 0;
                $marklist = [];
                $total_mark = [];
                foreach ($exam->unique('subject_id') as $eachexam) {
                    foreach ($eachexam->examsubject as $eachsubject) {
                        $count += 1;
                    }
                }
                foreach ($examsubjectmark->unique('student_id') as $key => $eachstudent) {
                    $mark1 = 0;
                    for ($i = 0; $i < $count; $i++) {
                        foreach ($exam as $eachexam) {
                            $mark1 += $eachexam->findmark($eachstudent->student->id, $eachstudent->examstudentsubjectlist[$i]);
                        }
                    }
                    if (sizeof($eachstudent->examstudentsubjectlist) == $eachstudent->examstudentsubjectlist->where('is_pass', true)->count()) {
                        for ($i = 0; $i < $count; $i++) {
                            $mark = 0;
                            foreach ($exam as $eachexam) {
                                $mark += $eachexam->findmark($eachstudent->student->id, $eachstudent->examstudentsubjectlist[$i]);
                            }
                        }
                        $total_mark[$eachstudent->student_id] = round($mark / ($count * sizeof($exam)));
                    }
                    $marklist[$key] = $mark1;
                }
                $totalstudentmark = round(array_sum($marklist) / ($count * sizeof($exam)));
                arsort($total_mark);
            @endphp
            @for ($i = 0; $i < $count; $i++)
                @foreach ($exam as $eachexam)
                    <td style="text-align: center;
                             border:1px solid black">
                        {{ $eachexam->name }}
                    </td>
                @endforeach
            @endfor
            <td style="text-align: center;
                             border:1px solid black">
                Overall %
            </td>
            <td style="text-align: center;
                             border:1px solid black">
                Grade
            </td>
            <td style="text-align: center;
                             border:1px solid black">
                Rank
            </td>
        </tr>

        @foreach ($examsubjectmark->unique('student_id') as $eachexammark)
            @php
                $marks = 0;
                $examattendance = 0;
                foreach ($exam as $eachexam) {
                    $examattendance += $eachexam->examsubject->avg('attendance_percentage');
                }
            @endphp
            <tr>
                <td style="text-align: center;
                             border:1px solid black">
                    {{ $eachexammark->student->name }}
                </td>
                @for ($i = 0; $i < $count; $i++)
                    @foreach ($exam as $eachexam)
                        @php
                            $marks += $eachexam->findmark($eachexammark->student->id, $eachexammark->examstudentsubjectlist[$i]);
                        @endphp
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachexam->findmark($eachexammark->student->id, $eachexammark->examstudentsubjectlist[$i]) }}
                        </td>
                    @endforeach
                @endfor
                <td style="text-align: center;
                             border:1px solid black">
                    {{ round($marks / ($count * sizeof($exam))) }}
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    @if ($eachexammark->examstudentsubjectlist->count() == $eachexammark->examstudentsubjectlist->where('is_pass')->count())
                        @foreach ($grade as $eachgrade)
                            @if ($eachgrade->percentage_from <= round($marks / ($count * sizeof($exam))) && $eachgrade->percentage_to > round($marks / ($count * sizeof($exam))))
                                {{ $eachgrade->name }}
                            @elseif(round($marks / ($count * sizeof($exam))) == 100 && $eachgrade->percentage_to == 100)
                                {{ $eachgrade->name }}
                            @endif
                        @endforeach
                    @else
                        F
                    @endif
                </td>
                <td style="text-align: center;
                             border:1px solid black">
                    @if ($eachexammark->examstudentsubjectlist->count() == $eachexammark->examstudentsubjectlist->where('is_pass')->count())
                        <span
                            class="text-green-600">{{ array_search($eachexammark->student_id, array_keys($total_mark)) + 1 }}</span>
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
            {{ round($examattendance / ($count * sizeof($exam))) }}
            %
        </td>
        <td style="text-align:center; padding:4px;">
            {{ round($totalstudentmark / sizeof($marklist)) }}
        </td>
        <td style="text-align:center; padding:4px;">
            {{ round((sizeof($total_mark) / sizeof($marklist)) * 100) }}
            %
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
