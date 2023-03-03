<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PaymentController extends Controller
{
    public function pay($id)
    {
        $order = Order::findOrFail($id);
        $amount = $order->amount;

        if ($amount == 0)
            return redirect(route('payments.price-zero'));

        $invoice = (new Invoice)->amount(intval($amount));


        return ShetabitPayment::callbackUrl(route('payments.callback'))
            ->purchase(
                $invoice,  //$total
                function ($driver, $transactionId) use ($order, $amount) {
                    $order->payments()->create(['resnumber' => $transactionId, 'amount' => $amount]);
                }
            )->pay()->render();
    }

    public function callback(Request $request)
    {
        try {
            $payment = Payment::where('resnumber', $request->id)->firstOrFail();
            $receipt = ShetabitPayment::amount($payment->order->amount)->transactionId($request->iN)->verify();

            $payment->update(['status' => 1]); //update payment status

            $payment->order()->update(['status' => 'paid',]); //update related order

            // $balance = $payment->order->user->balance ?? 0;
            // $payment->order->user->balance = $balance + $payment->order->amount;

            // $payment->order->user->save();
            // $payment->order()->update(['payment' => 'paid', 'status' => 'waiting']); //update related order
            // event(new PaymentSuccessful($payment->order));
            return \redirect('https://t.me/');
            // You can show payment referenceId to the user. echo $receipt->getReferenceId();
        } catch (InvalidPaymentException $exception) {
            return ($exception->getMessage());
        }
    }
}
