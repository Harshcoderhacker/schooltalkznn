<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Fee</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
            padding: 0;
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

        .logo {
            width: 50%;
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

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            vertical-align: middle !important;
            text-align: right;
            padding-right: 5px;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        /* .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        } */

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #6e6e6e;
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

        td div {
            padding: 5px 0;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="brand-section">
            <div style="text-align: center;">
                <h2>{{ App::make('generalsetting')->schoolname }}</h2>
                <p style="font-weight: bold">{{ App::make('generalsetting')->address }}</p>
            </div>

        </div>
        @if (!empty($feestudentpayment))
            <div class="header-section">
                <div class="row">
                    <div class="col-6">
                        <h2 class="heading"><span style="font-weight: bold">Admission No:</span>
                            {{ $feestudentpayment->student->addmission_number }}</h2>
                        <p class="sub-heading"><span style="font-weight: bold">Student Name:</span>
                            {{ $feestudentpayment->student->name }} </p>
                        <p class="sub-heading"><span style="font-weight: bold">Class:</span>
                            {{ $feestudentpayment->classmaster->name }} </p>
                        <p class="sub-heading"><span style="font-weight: bold">Section:</span>
                            {{ $feestudentpayment->section->name }}</p>
                    </div>
                    <div class="col-6" style=" text-align: right;">
                        <p class="sub-heading"><span style="font-weight: bold">Date:</span>
                            {{ $feestudentpayment->created_at->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="body-section">
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Fee Details</th>
                            <th>Taka</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="padding:5px;">
                                <div>{{ $feestudentpayment->feemaster->name }}</div>
                                <div>Paid</div>
                                <div>Discount</div>
                                <div>Unpaid</div>
                            </td>
                            <td style="padding:5px;">
                                <div>{{ $feestudentpayment->amount_to_pay }}</div>
                                <div>{{ $feestudentpayment->paying_amount }}</div>
                                <div>{{ $feestudentpayment->discount_amount }}</div>
                                <div>{{ $feestudentpayment->due_amount }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding:5px;" class="text-right">Total Payable Amount</td>
                            <td style="padding:5px;"> {{ $feestudentpayment->total_paid_amount }}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- <br>
            <h3 class="heading">Payment Status: Paid</h3>
            <h3 class="heading">Payment Mode: Cash on Delivery</h3> --}}
            </div>

            <div class="body-section footer_container">
                <div>Parent/Student</div>
                <div>Casier</div>
                <div>Officer</div>
            </div>
        @endif
    </div>

</body>

</html>
