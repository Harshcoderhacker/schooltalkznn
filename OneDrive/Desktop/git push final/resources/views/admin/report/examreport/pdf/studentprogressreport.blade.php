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
    <th style="text-align: center; border:1px solid black">
        Subject
    </th>
    <th style="text-align: center; border:1px solid black">
        Exam Name
    </th>
    <th style="text-align: center; border:1px solid black">
        Marks Obtained
    </th>
    <th style="text-align: center; border:1px solid black">
        Subject Grade
    </th>
    <th style="text-align: center; border:1px solid black">
        Remarks
    </th>
    @foreach ($exam->unique('subject_id') as $eachexam)
        @foreach ($eachexam->examsubject as $eachsubject)
            <tr>
                <td style="text-align: center; border:1px solid black">
                    {{ $eachsubject->subject->name }}
                </td>
                <td style="text-align: center; border:1px solid black">
                    <table style="margin-left: auto; margin-right:auto;">
                        @foreach ($exam as $eachexam)
                            <tr>
                                <td style="text-align: center;">{{ $eachexam->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td style=" border:1px solid black">
                    <table style="margin-left: auto; margin-right:auto;">
                        @foreach ($exam as $eachexam)
                            <tr>
                                <td style="text-align: center;">
                                    {{ $eachexam->overallmark($student->id, $eachsubject->subject_id) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td style="text-align: center; border:1px solid black">
                    <table style="margin-left: auto; margin-right:auto;">
                        @foreach ($exam as $eachexam)
                            <tr>
                                <td style="text-align: center;">
                                    @foreach ($grade as $eachgrade)
                                        @if ($eachgrade->percentage_from <= $eachexam->overallmark($student->id, $eachsubject->subject_id) && $eachgrade->percentage_to > $eachexam->overallmark($student->id, $eachsubject->subject_id))
                                            {{ $eachgrade->name }}
                                        @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == 100 && $eachgrade->percentage_to == 100)
                                            {{ $eachgrade->name }}
                                        @elseif($eachexam->overallmark($student->id, $eachsubject->subject_id) == '-')
                                            -
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td style="text-align: center; border:1px solid black">
                    <table style="margin-left: auto; margin-right:auto;">
                        @foreach ($exam as $eachexam)
                            <tr>
                                <td style="text-align: center;">
                                    {{ $eachexam->remark($student->id, $eachsubject->subject_id) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
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
            100 %
        </td>
        <td style="text-align:center; padding:4px;">
            6/20
        </td>
        <td style="text-align:center; padding:4px;">
            A
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
