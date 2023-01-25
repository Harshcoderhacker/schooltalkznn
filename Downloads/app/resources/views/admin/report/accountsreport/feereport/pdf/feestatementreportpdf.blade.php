<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Fee Statement</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .brand-section {
            padding: 10px 40px;
        }
    </style>
</head>

<body>
    @if ($feeassignstudent->isNotEmpty())

        <div style="overflow-x:auto;">
            <div class="brand-section">

                <div style="text-align: center;">
                    <h2>{{ App::make('generalsetting')->schoolname }}</h2>
                    <p style="font-weight: bold">{{ App::make('generalsetting')->address }}</p>
                </div>

            </div>

            <div style="margin: 10px 0 10px 0;">
                <table style="width: 100%;">
                    <tr>
                        <td><span style="font-weight:bold"> Student Name:</span> {{ $studentdetails->name }}</td>
                        <td><span style="font-weight:bold">Last Name:</span> {{ $studentdetails->last_name }}</td>
                    </tr>
                    <tr>
                        <td><span style="font-weight:bold">Father Name:</span> {{ $studentdetails->aparent->name }}
                        </td>
                        <td><span style="font-weight:bold">Admission No:</span>
                            {{ $studentdetails->addmission_number }}</td>
                    </tr>
                    <tr>
                        <td><span style="font-weight:bold">Mobile No:</span> {{ $studentdetails->phone_no }}
                        </td>
                        <td><span style="font-weight:bold">Roll No:</span> {{ $studentdetails->roll_no }}</td>
                    </tr>
                </table>
            </div>
            <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid black">
                <thead>
                    <tr style="border:1px solid black">
                        <th style="text-align: center;
                            border:1px solid black">
                            FEE
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            FEE PARTICULAR
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            STATUS
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            AMOUNT (RS)
                        </th>
                        <th style="text-align: center;
                        border:1px solid black">
                            PAYMENT ID
                        </th>
                        <th style="text-align: center;
                    border:1px solid black">
                            MODE
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            DATE
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            DISCOUNT (RS)
                        </th>
                        <th style="text-align: center;
                    border:1px solid black">
                            PAID (RS)
                        </th>
                        <th style="text-align: center;
                    border:1px solid black">
                            BALANCE (RS)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feeassignstudent as $eachfeeassignstudent)
                        <tr>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->feemaster->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->feemaster->feeparticular_name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->due_amount == 0 ? 'Paid' : 'Unpaid' }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">

                            </td>
                            <td style="text-align: center;
                            border:1px solid black">

                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->actual_amount }}
                            </td>
                            <td style="text-align: center;
                        border:1px solid black">-</td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->feestudentpayment->sum('discount_amount') }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeeassignstudent->total_paid_amount }}
                            </td>
                            <td style="text-align: center;
                        border:1px solid black">
                                {{ $eachfeeassignstudent->due_amount }}
                            </td>
                        </tr>
                        @foreach ($eachfeeassignstudent->feestudentpayment as $key => $eachfeestudentpayment)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;
                                border:1px solid black">{{ $eachfeestudentpayment->uniqid }}</td>
                                <td style="text-align: center;
                                border:1px solid black">
                                    {{ Config::get('archive.payment_mode')[$eachfeestudentpayment->payment_mode] }}
                                </td>
                                <td style="text-align: center;
                        border:1px solid black">
                                    {{ $eachfeestudentpayment ? $eachfeestudentpayment->created_at->format('d-M-Y h:i') : '-' }}
                                </td>
                                <td style="text-align: center;
                         border:1px solid black"> {{ $eachfeestudentpayment->discount_amount }}</td>
                                <td style="text-align: center;
                          border:1px solid black">{{ $eachfeestudentpayment->total_paid_amount }}</td>
                                <td style="text-align: center;
                           border:1px solid black">{{ $eachfeestudentpayment->due_amount }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
