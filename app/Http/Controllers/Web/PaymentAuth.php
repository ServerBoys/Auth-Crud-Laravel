<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PaymentCheckRequest;
use App\Models\PremiumSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentAuth extends Controller
{
    public string $merchant_id = "EPAYTEST";
    public string $order_id = "premiuio";
    static string $success_code = "<response>\\n<response_code>\\nSuccess\\n<\\/response_code>\n<\\/response>";
    static string $failure_code = "<response>\\n<response_code>\\nfailure\\n<\\/response_code>\n<\\/response>";
    public function pay() {
        if (auth()->user()->premium_subscription !== null) {
            return redirect()->route('home.index')->withErrors(["Already a member"]);
        }
        $amount = 1000;
        $delivery_charge = 0;
        $service_charge = 0;
        $tax_amount = 13/100 * $amount;
        $success_url = route('pay.check');
        $failed_url = route('pay.declined');
        $esewa_url = "https://uat.esewa.com.np/epay/main/";

        $data = [
            'amt' => $amount,
            'pdc' => $delivery_charge,
            'psc' => $service_charge,
            'txAmt' => $tax_amount,
            'tAmt' => $amount + $delivery_charge + $service_charge + $tax_amount,
            'pid' => $this->order_id,
            'scd' => $this->merchant_id,
            'su' => $success_url,
            'fu' => $failed_url
        ];
        return view('auth.pay', $data);
    }

    public function pay_check(PaymentCheckRequest $request) {
        $esewa_url = "https://uat.esewa.com.np/epay/transrec/";
        $data = [
            'amt'=> $request->amt,
            'rid'=> $request->refId,
            'pid'=> $request->oid,
            'scd'=> $this->merchant_id
        ];


        $curl = curl_init($esewa_url . "?" .http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($curl);
        curl_close($curl);

        if (strcmp($resp, $this::$success_code)) {
            if (auth()->user()->premium_subscription !== null) {
                return redirect()->route('home.index')->withErrors(["Already a member"]);
            }
            if (PremiumSubscription::where('ref_id', $data['rid'])->first() !== null) {
                return redirect()->route('home.index')->withErrors(["Already used the same payment for different subscription"]);
            }
            $this->set_premium_subscription($data['rid']);
            return redirect()->route('home.index')->with('success', "Subscription Purchased.");
        } else if (strcmp($resp, $this::$failure_code)) {
            return redirect()->route('home.index')->withErrors(["Payment Cancelled"]);
        } else {
            return redirect()->route('home.index')->withErrors(["Some type of error occurred in between. Please contact us if payment was made but you didn't get the subscription"]);
        }
    }

    public function set_premium_subscription(string $ref_id) {
        PremiumSubscription::create(['user_id' => auth()->user()->id, 'ref_id' => $ref_id]);
    }

    public function pay_declined() {
        return redirect()->route('home.index')->withErrors(["Payment Declined"]);
    }
}
