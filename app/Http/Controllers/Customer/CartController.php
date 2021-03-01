<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\PostCartRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Save or Update Cart request from user.
     *
     * @param PostCartRequest $request
     * @return json
     */
    public function storeOrUpdate(PostCartRequest $request)
    {
        try {
            DB::beginTransaction();
            $cart = Cart::where('user_id',  auth()->user()->id)->first();
            $productDetail = ProductDetail::with(['product'])->find($request->product_detail);

            //check if different seller
            if ($cart && $cart->seller_id !== $productDetail->product->seller_id)  return ResponseFormatter::error('Anda hanya boleh memasukkan produk dengan penjual yang sama, apakah anda ingin menghapus keranjang sebelumnya?', 410);

            if (!$cart && $productDetail) {
                $cart = Cart::create([
                    'user_id' => auth()->user()->id,
                    'seller_id' => $productDetail->product->seller_id,
                    'total' => 0
                ]);
            }

            $cartDetail =  CartDetail::where('product_detail_id',  $request->product_detail)->where('cart_id',  $cart->id)->first();

            //check if cart was available
            if ($cartDetail) {
                $subtotal = $cartDetail->subtotal + $productDetail->price * $request->qty;
                $quantity = $cartDetail->quantity + $request->qty;
                $cartDetail->update(compact(['subtotal', 'quantity']));
            } else {
                $subtotal = $productDetail->price * $request->qty;
                $cartDetail = CartDetail::create([
                    'cart_id' => $cart->id,
                    'product_detail_id' => $request->product_detail,
                    'quantity' => $request->qty,
                    'subtotal' => $subtotal,
                ]);
            }

            $cart->update([
                'total' => $cartDetail->where('cart_id',  $cart->id)->sum('subtotal')
            ]);

            DB::commit();
            return ResponseFormatter::success(['cartDetail' => $cartDetail], 'Berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
