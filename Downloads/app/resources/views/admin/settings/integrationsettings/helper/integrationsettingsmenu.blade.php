<div class="col-start-3 col-end-11 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('paymentintegration.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'payment' ? 'bg-primary text-white' : '' }}">Payment
                    Integration</a>
                <a href="{{ route('smsintegration.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'sms' ? 'bg-primary text-white' : '' }}">SMS
                    Integration</a>
                <a href="{{ route('emailintegration.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'email' ? 'bg-primary text-white' : '' }}">Email
                    Integration</a>
                <a href="{{ route('fcmintegration.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'fcm' ? 'bg-primary text-white' : '' }}">FCM
                    Integration</a>
            </div>
        </div>
    </div>
</div>