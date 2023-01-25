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
    <div>Staff Name : {{ $staff->name }}</div>
    <div>Staff ID : {{ $staff->staff_roll_id }}</div>
    <div>Staff Designation : {{ $staff->staffdesignation->name }}</div>
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
        @foreach ($staffattendance as $key => $eachstaffattendance)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($eachstaffattendance->staffattendance->attendance_date)->format('d-M-Y') }}
                </td>
                <td>{{ $eachstaffattendance->present ? 'P' : '' }}</td>
                <td>{{ $eachstaffattendance->late ? 'L' : '' }}</td>
                <td>{{ $eachstaffattendance->absent ? 'A' : '' }}</td>
                <td>{{ $eachstaffattendance->halfday ? 'HD' : '' }}</td>
            </tr>
        @endforeach
    </table>

    <p>Total Days : 24</p>
    <p>No of Days Present : {{ $staffattendance->sum('present') }}</p>
    <p>No of Days Absent : {{ $staffattendance->sum('absent') }}</p>
    <p>Attendance Score : {{ round(($staffattendance->sum('present') / 26) * 100) }}</p>




</body>

</html>
