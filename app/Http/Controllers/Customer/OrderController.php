<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetOrderRequest;
use App\Http\Requests\Customer\PostOrderRequest;
use App\Models\Address;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetOrderRequest $request
     * @return json
     */
    public function index(GetOrderRequest $request)
    {
        try {
            if ($request->has('id')) {
                $order = Order::with(['user', 'seller', 'orderdetails.productdetail.productunit'])->where('user_id', auth()->user()->id)->find($request->id);

                if ($order) return ResponseFormatter::success($order, 'Data Pemesanan berhasil diambil');

                return ResponseFormatter::error("Data Pemesanan tidak ditemukan", 400);
            }

            $orders = Order::query();

            if ($request->has('status')) return $orders->where('status', $request->status);

            $limit = $request->input('limit', 6);

            $orders->with(['user', 'seller', 'orderdetails.productdetail.productunit'])->where('user_id', auth()->user()->id);

            return ResponseFormatter::success(
                $orders->paginate($limit),
                'Data list pemesaan berhasil diambil'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostOrderRequest  $request
     * @return json
     */
    public function store(PostOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $cart = Cart::where('user_id', '=', auth()->user()->id)->with(['cartdetails'])->first();

            if (!$cart) return ResponseFormatter::error('Keranjang anda kosong', 400);

            if ($request->shipping_method == 0) {
                $address = Address::where('user_id', auth()->user()->id)->first();

                if (!$address) return ResponseFormatter::error('Alamat tidak ditemukan', 400);
            }

            $order = Order::create([
                'user_id' => $cart->user_id,
                'seller_id' => $cart->seller_id,
                'shipping_method' => $request->input('shipping_method', 0),
                'village_id' => $address->village_id ?? null,
                'customer_addressName' => $address->name ?? null,
                'customer_address' => $address->address ?? null,
                'order_at' => now(),
                'expire_at' => now()->addDay(),
                'status' => 0
            ]);

            if ($order) {
                foreach ($cart->cartdetails as $cartdetail) {
                    try {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_detail_id' => $cartdetail->product_detail_id,
                            'quantity' => $cartdetail->quantity,
                            'subtotal' => $cartdetail->subtotal,
                        ]);
                    } catch (\Exception $e) {
                        return ResponseFormatter::error($e->getMessage(), 400);
                    }
                }

                $billing = Billing::create([
                    'order_id' => $order->id,
                    'payment_method_id' => $request->payment_method,
                    'total' => $cart->total,
                    'status' => 0
                ]);

                $cart->delete();
                $cart->cartdetails()->delete();

                DB::commit();

                if ($billing) return ResponseFormatter::success(['order' => $order, 'payment' => $billing], 'Pemesanan berhasil, silahkan lakukan pembayaran');
            }

            return ResponseFormatter::error('Pemesanan tidak berhasil, harap periksa kembali', 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
