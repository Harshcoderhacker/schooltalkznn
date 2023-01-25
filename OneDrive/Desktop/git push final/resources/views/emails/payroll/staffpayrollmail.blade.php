@component('mail::message')
    # Dear {{ $payrolleachmonth->name }}

    Please Find Attached Your {{ App::make('generalsetting')->schoolname }} Payslip for
    {{ $payrolleachmonth->month_string }}

    Payslip are Strictly Confidential

    Thanks,
    {{ config('app.name') }}
@endcomponent
