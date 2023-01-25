@component('mail::message')
<style type="text/css">
    .card {
        width: 500px;
        background-color: rgba(38, 33, 94, 1);
        border-radius: 4px;
    }

    .card-body {
        padding: 40px 40px !important;
    }

    .text-center {
        text-align: center;
    }

    .text-dark {
        color: #000 !important;
    }

    .bg-light {
        background-color: #fff !important;
    }

    .mb-5 {
        margin-bottom: 3rem !important;
    }

    span.p-3 {
        padding: 14px 40px;
    }

    h5,
    p,
    small,
    h2,
    h3 {
        color: #ffffff !important;
    }

    .txt_1 {

        font-size: 12px !important;
    }

    .mb-0 {
        margin-bottom: 0px !important;
    }

    .mb-1 {
        margin-bottom: 10px !important;
    }
</style>

<div class="card">
    <div class="card-body">
        <!-- <img class="text-center" src="{{ asset('dist/images/logo.svg') }}"> -->
        <h5 class="card-title mb-5 text-center">Let's get you signed in</h5>
        <p class="card-text">We use this easy login code so you don't have to remember or type in yet another long password.</p>
        <p class="card-text">Your login code is</p>
        <p class="text-center"><span class="p-3 text-dark bg-light">{{$body['otp']}}</span></p>
        <p class="text-center"><small>Please note this code is valid only for 15 minutes.</small></p>
        <h3 class="mb-0">Have questions or trouble logging in?</h3>
        <p class="mb-5 txt_1">Just reply to this email or contact <a href="#"><span>support@schooltalk.com</span></a></p>
        <h4 class="text-center mb-1">All the best</h4>
        <h2 class="text-center">SchoolTalkz Team</h2>
    </div>
</div>

<!-- <h2>Hello {{$body['name']}},</h2> -->

Thanks,<br>
{{ config('app.name') }}

@endcomponent