<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>

<body>

    <center>
        <h2>{{ App::make('generalsetting')->schoolname }}</h2>
    </center>


    <h3>Attendance Report For {{ $monthlist->month_string }}</h3>
    <div>Student Name : {{ $student->name }}</div>
    <div>Roll Number : {{ $student->roll_no }}</div>
    <div>Class & Section : {{ $student->classmaster->name }} - {{ $student->section->name }}</div>
    <br>
    <table>
        <tr>
            <th>S.No</th>
            <th>Attendance Date</th>
            <th>Present</th>
            <th>Late</th>
            <th>Absent</th>
            <th>Halfday</th>
        </tr>
        @foreach ($studentattendance as $key => $eachstudentattendance)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($eachstudentattendance->studentattendance->attendance_date)->format('d-M-Y') }}
                </td>
                <td>{{ $eachstudentattendance->present ? 'P' : '' }}</td>
                <td>{{ $eachstudentattendance->late ? 'L' : '' }}</td>
                <td>{{ $eachstudentattendance->absent ? 'A' : '' }}</td>
                <td>{{ $eachstudentattendance->halfday ? 'HD' : '' }}</td>
            </tr>
        @endforeach
    </table>

    <p>Total Days : 24</p>
    <p>No of Days Present : {{ $studentattendance->sum('present') }}</p>
    <p>No of Days Absent : {{ $studentattendance->sum('absent') }}</p>
    <p>Attendance Score : {{ round(($studentattendance->sum('present') / 26) * 100) }}</p>




</body>

</html>
