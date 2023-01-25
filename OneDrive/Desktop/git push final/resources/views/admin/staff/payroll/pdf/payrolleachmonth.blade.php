<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="6" style="font-weight: bold;">
                    <h4>
                        {{ App::make('generalsetting')->schoolname }}
                    </h4>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center;">
                <td colspan="6">
                    {{ App::make('generalsetting')->address }}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:center;">
                    <span> School Code: {{ App::make('generalsetting')->code }} </span>
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;">Pay Slip for the month of
                    <span style="font-weight: bold;">
                        {{ Carbon\Carbon::parse($payrolleachmonth->month_string)->format('M Y') }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="3"><span style="font-weight: bold;">Staff Name:</span> {{ $payrolleachmonth->name }}</td>
                <td colspan="3"><span style="font-weight: bold;">Staff Id:</span>
                    {{ $payrolleachmonth->staff_roll_id }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Staff Phone:</td>
                <td colspan="2">{{ $payrolleachmonth->phone }}</td>

                <td style="font-weight: bold;">Permanent Account Number (PAN):</td>
                <td colspan="2">{{ $payrolleachmonth->phone }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Department:</td>
                <td colspan="2"> {{ $payrolleachmonth->staff->staffdepartment?->name }}</td>
                <td style="font-weight: bold;">Designation:</td>
                <td colspan="2">{{ $payrolleachmonth->staff->staffdesignation?->name }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Date of joining:</td>
                <td colspan="2">{{ \Carbon\Carbon::parse($payrolleachmonth->staff?->doj)->format('d-M-Y') }}</td>
                <td style="font-weight: bold;">EDF Number:</td>
                <td colspan="2">{{ $payrolleachmonth->staff->edf_number }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total No. of Days Present:</td>
                <td colspan="2">{{ $payrolleachmonth->no_of_days_present }}</td>
                <td style="font-weight: bold;">Total No. of Days Absent:</td>
                <td colspan="2">{{ $payrolleachmonth->no_of_days_absent }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Half days:</td>
                <td colspan="2">{{ $payrolleachmonth->halfdays }}</td>
                <td style="font-weight: bold;">No. LOP days:</td>
                <td colspan="2">{{ $payrolleachmonth->lop }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Earnings</td>
                <td colspan="2" style="font-weight: bold;">Amount
                </td>
                <td style="font-weight: bold;">Deductions</td>
                <td colspan="2" style="font-weight: bold;">Amount
                </td>
            </tr>
            <tr>
                @if ($earning_breakup)
                    @foreach ($earning_breakup as $earning)
                        <td>{{ $earning->name }}</td>
                        <td colspan="2">{{ $earning->value }}</td>
                    @endforeach
                @endif

                @if ($deduction_breakup)
                    @foreach ($deduction_breakup as $deduction)
                        <td>{{ $deduction->name }}</td>
                        <td colspan="2">{{ $deduction->value }}</td>
                    @endforeach
                @endif
            </tr>
            {{-- <tr>
                <td></td>
                <td colspan="2"></td>
                <td style="font-weight: bold;">LOP DEDUCTION</td>
                <td colspan="2">
                </td>
            </tr> --}}
            <tr>
                <td style="font-weight: bold;">Total Earnings</td>
                <td colspan="2"> {{ $payrolleachmonth->earning }} </td>

                <td style="font-weight: bold;">Total Deductions</td>
                <td colspan="2">{{ $payrolleachmonth->deduction }}</td>

            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-weight: bold;">Net Amount</td>
                <td colspan="2">{{ $payrolleachmonth->net_salary }} </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-weight: bold;">TAX</td>
                <td colspan="2">{{ $payrolleachmonth->tax }} </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-weight: bold;">Gross Salary</td>
                <td colspan="2">{{ $payrolleachmonth->gross_salary }} </td>
            </tr>
            <tr>
                <td colspan="6"><span style="font-weight: bold;">Rupees: </span> {{ ucwords($rupees) }}</td>
            </tr>
            <tr>
                <td colspan="3"><br><br><br><br>Staff's signature </td>
                <td colspan="3" style="text-align: right;">
                    For {{ App::make('generalsetting')->schoolname }}
                    <br> <br><br>Authorised Signatory
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
