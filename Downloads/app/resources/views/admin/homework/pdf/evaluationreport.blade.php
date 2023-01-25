<!DOCTYPE html>
<html>

<head>
    <title>Evaluation Report</title>
    <style>
        th,
        td {
            padding: 8px;
        }

    </style>
</head>

<body>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th colspan="6" style="font-weight: bold;">
                    <h2>
                        {{ App::make('generalsetting')->schoolname }}
                    </h2>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:left;">
                <td colspan="3">
                    <span style="font-weight: bold;">Class</span> : {{ $homework->classmaster->name }}
                </td>
                <td colspan="3">
                    <span style="font-weight: bold;">Section</span> : {{ $homework->Section->name }}
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="3">
                    <span style="font-weight: bold;">Homework Title</span> : {{ $homework->title }}
                </td>
                <td colspan="3">
                    <span style="font-weight: bold;">Marks</span> : {{ $homework->marks }}
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="6">
                    <span style="font-weight: bold;">Description</span> : {{ $homework->description }}
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="6">
                    <span style="font-weight: bold;">Created By</span> : {{ $homework->created_by }}
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="6">
                    <span style="font-weight: bold;">Due Date</span> :
                    {{ \Carbon\Carbon::parse($homework->due_date)->format('d/m/Y') }}
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="6">
                    <span style="font-weight: bold;">Completion Percentage</span> : {{ $percentage }} %
                </td>
            </tr>
            <tr style="text-align:left;">
                <td colspan="6">
                    <span style="font-weight: bold;">Average Time Taken By a Student</span> : 2
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid black;">
        <thead>
            <tr style="border:1px solid black;">
                <th style="text-align: center; border:1px solid black;">
                    Roll Number
                </th>
                <th style="text-align: center; border:1px solid black;">
                    Student Name
                </th>
                <th style="text-align: center; border:1px solid black;">
                    Marks
                </th>
                <th style="text-align: center; border:1px solid black;">
                    Submitted Time
                </th>
                <th style="text-align: center; border:1px solid black;">
                    Time Taken to Complete
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($homeworklist as $eachhomeworklist)
                <tr style="border:1px solid black;">
                    <td style="text-align: center; border:1px solid black;">
                        {{ $eachhomeworklist->student->addmission_number }}
                    </td>
                    <td style="text-align: center; border:1px solid black;">
                        {{ $eachhomeworklist->student->name }}
                    </td>
                    <td style="text-align: center; border:1px solid black;">
                        {{ $eachhomeworklist->marks ? $eachhomeworklist->marks : '-' }}
                    </td>
                    <td style="text-align: center; border:1px solid black;">
                        -
                    </td>
                    <td style="text-align: center; border:1px solid black;">
                        -
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
