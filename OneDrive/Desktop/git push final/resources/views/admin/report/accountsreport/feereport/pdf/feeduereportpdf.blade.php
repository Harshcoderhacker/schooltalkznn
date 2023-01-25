<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Due Report</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 80%;
            margin: 50px auto 50px auto;
            border: 1px solid rgb(173, 173, 173);
        }

        .brand-section {
            padding: 10px 40px;
            border-bottom: 1px solid rgb(173, 173, 173);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-4 {
            width: 20%;
            flex: 0 0 auto;
        }

        .col-8 {
            width: 80%;
            flex: 0 0 auto;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .body-section {
            padding: 16px;
        }

        .header-section {
            padding: 16px;
            border-bottom: 1px solid rgb(173, 173, 173);
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }

        .footer_container {
            display: flex;
            justify-content: space-between;
            padding-top: 50px;
        }

    </style>
</head>

<body>
    @if ($studentduelist->isNotEmpty())

        <div style="overflow-x:auto;">
            <div class="brand-section">
                <div style="text-align: center;">
                    <h2>{{ App::make('generalsetting')->schoolname }}</h2>
                    <p style="font-weight: bold">{{ App::make('generalsetting')->address }}</p>
                </div>
            </div>
            <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid black">
                <thead>
                    <tr style="border:1px solid black">
                        <th style="text-align: center;
                            border:1px solid black">
                            STUDENT NAME
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            ADMISSION NO
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            ROLL NO
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            FATHER NAME
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            AMOUNT (Rs)
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
                    @foreach ($studentduelist as $eachstudentduelist)
                        <tr>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->addmission_number }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->roll_no }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->aparent->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->feeassignstudent->sum('actual_amount') }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->feeassignstudent->sum('discount_amount') }}
                            </td>
                            <td style="text-align: center;
                        border:1px solid black">
                                {{ $eachstudentduelist->feeassignstudent->sum('total_paid_amount') }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachstudentduelist->feeassignstudent->sum('due_amount') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
