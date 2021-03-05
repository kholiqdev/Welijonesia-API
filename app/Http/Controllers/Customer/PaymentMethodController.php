<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetPaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param GetPaymentMethodRequest $request
     * @return json
     */
    public function __invoke(GetPaymentMethodRequest $request)
    {
        try {
            if ($request->has('id')) {
                $paymentMethod = PaymentMethod::find($request->id);

                if ($paymentMethod) return ResponseFormatter::success(['paymentMethod' => $paymentMethod], 'Metode Pembayaran ditemukan');

                return ResponseFormatter::error("Metode Pembayaran tidak ditemukan", 400);
            }

            $paymentMethod = PaymentMethod::all();
            return ResponseFormatter::success(
                ['paymentMethod' => $paymentMethod],
                $paymentMethod->count() . ' Metode Pembayaran ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
