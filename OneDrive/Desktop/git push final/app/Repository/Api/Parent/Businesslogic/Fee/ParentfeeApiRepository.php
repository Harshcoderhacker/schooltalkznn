<?php

namespace App\Repository\Api\Parent\Businesslogic\Fee;

use App\Http\Resources\Parent\Accounts\Fee\Feepaymenthistory\ParentfeepaymenthistoryCollection;
use App\Http\Resources\Parent\Accounts\Fee\Feepaymentinformation\ParentfeepaymentinformationCollection;
use App\Http\Resources\Parent\Accounts\Fee\Pendingfeelist\ParentpendingfeeCollection;
use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Integration\Paymentintegration;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Fee\IParentfeeApiRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class ParentfeeApiRepository implements IParentfeeApiRepository
{
    public function parentfeeindex()
    {
        $paymentintegration = Paymentintegration::where('is_default', true)->first();
        return [true,
            ['due_amount' => round(Feeassignstudent::where('student_id', Parenthelper::getstudentid())->sum('due_amount'), 2),
                'gateway_key' => $paymentintegration->gateway_secret_key,
                'gateway_secret' => $paymentintegration->gateway_publisher_key,
            ],
            'parentfeeindex'];
    }

    public function parentpendingfeelist()
    {

        $fee = Feeassignstudent::with('feemaster')
            ->where('student_id', Parenthelper::getstudentid())
            ->where('due_amount', '<>', 0)
            ->get();

        return [true,
            [
                [
                    'full_payment' => new ParentpendingfeeCollection($fee),
                    'fullpayment_due' => round($fee->sum('due_amount'), 2),
                    'fullpayment_uuid' => $fee->pluck('uuid'),
                    'payment_type' => 1, // Full payment
                ],
                [
                    'single_payment' => new ParentpendingfeeCollection($fee),
                    'payment_type' => 2, // Single payment
                ],
            ]
            ,
            'parentpendingfeelist'];
    }

    public function parentfeepayonline()
    {

        $user = auth()->user();
        $data['feeassignstudent_uuid'] = request('feeassignstudent_uuid');
        $data['amount'] = round(Feeassignstudent::where('student_id', Parenthelper::getstudentid())
            ->where('uuid', request('feeassignstudent_uuid'))->first()->due_amount,2);

        $data['name'] = $user->name;
        $data['contact'] = $user->phone;
        $data['email'] = $user->email;
        $data['payment_type'] = request('payment_type');

        return [true, $data, 'parentfeepayonline'];

    }

    public function parentfeepaymentstore()
    {
        if (request('payment_type') == 2) {
            $feeassignstudent = Feeassignstudent::where('uuid', request('feeassignstudent_uuid'))->first();
            $feestudentpayment = Feestudentpayment::create([
                'feemaster_id' => $feeassignstudent->feemaster_id,
                'feeassignstudent_id' => $feeassignstudent->id,

                'classmaster_id' => $feeassignstudent->classmaster_id,
                'section_id' => $feeassignstudent->section_id,
                'academicyear_id' => $feeassignstudent->academicyear_id,
                'aparent_id' => $feeassignstudent->aparent_id,
                'student_id' => $feeassignstudent->student_id,
                'feediscount_id' => null,

                'amount_to_pay' => $feeassignstudent->due_amount,
                'paying_amount' => request('amount'), // $amount,
                'discount_amount' => 0,
                'total_paid_amount' => request('amount'), // $amount,
                'due_amount' => 0,
                'payment_mode' => 2,
                'type' => 3, // 1- Admin ,2- Parent Web, 3- Parent Mobile

                'gateway_payment_id' => request('gateway_payment_id'),
            ]);

            $feeassignstudent->update([
                'total_paid_amount' => $feeassignstudent->total_paid_amount + $feestudentpayment->total_paid_amount,
                'due_amount' => $feestudentpayment->due_amount,
                'is_lock' => true,
            ]);
        } elseif (request('payment_type') == 1) {
            $feeassignstudent_uuid = explode(',', request('feeassignstudent_uuid'));
            foreach ($feeassignstudent_uuid as $key => $eachfeeassignstudent_uuid) {
                $feeassignstudent = Feeassignstudent::where('uuid', $eachfeeassignstudent_uuid)->first();
                $feestudentpayment = Feestudentpayment::create([
                    'feemaster_id' => $feeassignstudent->feemaster_id,
                    'feeassignstudent_id' => $feeassignstudent->id,

                    'classmaster_id' => $feeassignstudent->classmaster_id,
                    'section_id' => $feeassignstudent->section_id,
                    'academicyear_id' => $feeassignstudent->academicyear_id,
                    'aparent_id' => $feeassignstudent->aparent_id,
                    'student_id' => $feeassignstudent->student_id,
                    'feediscount_id' => null,

                    'amount_to_pay' => $feeassignstudent->due_amount,
                    'paying_amount' => request('amount'), // $amount,
                    'discount_amount' => 0,
                    'total_paid_amount' => request('amount'), // $amount,
                    'due_amount' => 0,
                    'payment_mode' => 2,
                    'type' => 3, // 1- Admin ,2- Parent Web, 3- Parent Mobile

                    'gateway_payment_id' => request('gateway_payment_id'),
                ]);

                $feeassignstudent->update([
                    'total_paid_amount' => $feeassignstudent->total_paid_amount + $feestudentpayment->total_paid_amount,
                    'due_amount' => $feestudentpayment->due_amount,
                    'is_lock' => true,
                ]);
            }
        }

        return [true, 'success', 'parentfeepaymentstore'];

    }

    public function parentfeepaymentinformation()
    {
        return [true,
            new ParentfeepaymentinformationCollection(
                Feeassignstudent::with('feemaster')
                    ->where('student_id', Parenthelper::getstudentid())
                    ->paginate(15)
            ),
            'parentfeepaymentinformation'];
    }

    public function parentfeepaymenthistory()
    {
        return [true,
            new ParentfeepaymenthistoryCollection(
                Feestudentpayment::with('feemaster')
                    ->where('student_id', Parenthelper::getstudentid())
                    ->paginate(15)
            ),
            'parentfeepaymenthistory'];
    }

    public function parentfeepaymentdownload()
    {

        $feestudentpayment = Feestudentpayment::with('feemaster')
            ->where('student_id', Parenthelper::getstudentid())
            ->where('uuid', request('feepayment_uuid'))
            ->first();

        return Pdf::loadView('admin.fees.feescollected.feereceipt', compact('feestudentpayment'));

    }

    public function parentfeequery()
    {
        return [true,
            'Test',
            'parentfeequery'];
    }
}
