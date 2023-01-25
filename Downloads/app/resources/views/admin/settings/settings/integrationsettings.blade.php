<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Integration</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('paymentintegration.index') }}"
                    class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Payment"
                                src="{{ asset('/image/settingsicon/integration/sms.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Payment
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('smsintegration.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="SMS"
                                src="{{ asset('/image/settingsicon/integration/sms.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">SMS
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('emailintegration.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Emails"
                                src="{{ asset('/image/settingsicon/integration/emails.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Emails
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('fcmintegration.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Emails"
                                src="{{ asset('/image/settingsicon/integration/task.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">FCM
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>