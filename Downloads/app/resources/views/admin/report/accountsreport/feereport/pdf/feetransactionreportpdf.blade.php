<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Transaction Report</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .brand-section {
            padding: 10px 40px;
            border-bottom: 1px solid rgb(173, 173, 173);
        }

    </style>
</head>

<body>
    @if ($feestudentpaymentlist->isNotEmpty())

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
                            PAYMENT ID
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            DATE
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            STUDENT NAME
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            CLASS - SECTION
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            FEE TYPE
                        </th>
                        <th style="text-align: center;
                        border:1px solid black">
                            MODE
                        </th>
                        <th style="text-align: center;
                        border:1px solid black">
                            AMOUNT (Rs)
                        </th>
                        <th style="text-align: center;
                            border:1px solid black">
                            DISCOUNT (Rs)
                        </th>
                        <th style="text-align: center;
                    border:1px solid black">
                            TOTAL (Rs)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feestudentpaymentlist as $eachfeestudentpaymentlist)
                        <tr>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->uniqid }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->created_at->format('d-m-Y') }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->student->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->classmaster->name }} -
                                {{ $eachfeestudentpaymentlist->section->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->feemaster->name }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ Config::get('archive.payment_mode')[$eachfeestudentpaymentlist->payment_mode] }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->amount_to_pay }}
                            </td>
                            <td style="text-align: center;
                        border:1px solid black">
                                {{ $eachfeestudentpaymentlist->discount_amount }}
                            </td>
                            <td style="text-align: center;
                            border:1px solid black">
                                {{ $eachfeestudentpaymentlist->total_paid_amount }}
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
