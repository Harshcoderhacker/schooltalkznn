<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Integration\Emailintegration;
use App\Models\Admin\Settings\Integration\Paymentintegration;
use App\Models\Admin\Settings\Integration\Smsintegration;
use Illuminate\Database\Seeder;

class SettingsintegrationTableSeeder extends Seeder
{
    public function run()
    {
        $paymentintegration = [
            ['gateway_id' => 1,
                'gateway_name' => 'Razorpay',
                'gateway_username' => 'edfish_razorpay',
                'gateway_secret_key' => 'rzp_test_L3jTf15hBzroY3',
                'gateway_publisher_key' => 'Bcw42ir8kkX8nc88e1aW2WU4',
                'is_default' => true,
            ],
            // [
            //     'gateway_id' => 2,
            //     'gateway_name' => 'Instamojo',
            //     'gateway_username' => 'edfish_instamojo',
            //     'gateway_secret_key' => 'dsdSDCCascedcweEACdwd$#FasascascQW@!#$!@$!@!@CZCSDCABE',
            //     'gateway_publisher_key' => '845513182ascascwdvbrnyteqvfverAStt',
            //     'is_default' => false,
            // ],
        ];

        foreach ($paymentintegration as $row) {
            Paymentintegration::create($row);
        }

        Smsintegration::create([
            'provider_name' => 'test',
            'sid' => 'test',
            'sender_id' => 'test',
            'token' => 'test',
            'url' => 'test',
            'country_code' => 'test',
            'phone_no' => '7395944078',
            'is_default' => true,
        ]);

       /* Emailintegration::create([
            'provider_name' => 'Google',
            'email_from_name' => 'Edfish',
            'email_from_mail' => 'vimalrajedfish@gmail.com',
            'email_mail_driver' => 'smtp',
            'email_mail_host' => 'smtp.googlemail.com',
            'email_mail_port' => 465,
            'email_mail_username' => 'vimalrajedfish@gmail.com',
            'email_mail_password' => 'edfish123',
            'email_mail_encryption' => 'ssl',
            'is_default' => true,
        ]);*/
    }
}
