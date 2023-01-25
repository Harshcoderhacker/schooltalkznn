<?php

namespace App\Http\Controllers\Web\Parent\Fee;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Integration\Paymentintegration;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class ParentfeeController extends Controller
{

    public function parentfee()
    {
        return view('parent/fee/parentfee');
    }

    public function parentfeeinvoice()
    {
        return view('parent/fee/parentfeeinvoice');
    }

    public function parentfeepaymentstore(Request $request)
    {
        $input = $request->all();
        $paymentintegration = Paymentintegration::where('is_default', true)->first();
        $api = new Api($paymentintegration->gateway_secret_key, $paymentintegration->gateway_publisher_key);
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $student = Parenthelper::getstudentweb();

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                DB::beginTransaction();
                $paymentgateway_details = $payment->capture(array('amount' => $payment['amount']));
                $feeassignstudent = Feeassignstudent::where('uuid', $request->uuid)->first();
                $feestudentpayment = Feestudentpayment::create([
                    'feemaster_id' => $feeassignstudent->feemaster_id,
                    'feeassignstudent_id' => $feeassignstudent->id,

                    'classmaster_id' => $feeassignstudent->classmaster_id,
                    'section_id' => $feeassignstudent->section_id,
                    'academicyear_id' => $feeassignstudent->academicyear_id,
                    'aparent_id' => $feeassignstudent->aparent_id,
                    'student_id' => $feeassignstudent->student_id,

                    'amount_to_pay' => $feeassignstudent->due_amount,
                    'paying_amount' => $feeassignstudent->due_amount, // $paymentgateway_details['amount'],
                    'discount_amount' => 0,
                    'total_paid_amount' => $feeassignstudent->due_amount, //$paymentgateway_details['amount'],
                    'due_amount' => 0,
                    'payment_mode' => 2,
                    'type' => 2, // 1- Admin ,2- Parent Web, 3- Parent Mobile

                    'gateway_payment_id' => $request->razorpay_payment_id,
                ]);

                $feeassignstudent->update([
                    'total_paid_amount' => $feeassignstudent->total_paid_amount + $feestudentpayment->total_paid_amount,
                    'due_amount' => $feestudentpayment->due_amount,
                    'is_lock' => true,
                ]);

                DB::commit();
                toast('Paymenent Success', 'success', 'top-right');
                Helper::trackmessage($student, 'Student Fee Payment', 'student_fee_payment', session()->getId(), 'WEB');

                return redirect()->route('parentfee');

            } catch (Exception $e) {
                $this->exceptionerror('parent_fee_payment', 'one', $e);
            } catch (QueryException $e) {
                $this->exceptionerror('parent_fee_payment', 'two', $e);
            } catch (PDOException $e) {
                $this->exceptionerror('parent_fee_payment', 'three', $e);
            }
        }
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
