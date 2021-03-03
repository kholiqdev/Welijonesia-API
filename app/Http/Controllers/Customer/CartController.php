<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\DeleteCartRequest;
use App\Http\Requests\Customer\GetCartRequest;
use App\Http\Requests\Customer\PostCartRequest;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductDetail;
use Exception;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Get Cart from db
     *
     * @return json
     */
    public function index()
    {
        try {
            $cart = Cart::with(['cartdetails.productdetail.productunit', 'cartdetails.productdetail.product.comodity.category', 'seller'])->where('user_id', auth()->user()->id)->first();

            if ($cart) return ResponseFormatter::success(['cart' => $cart], count($cart->cartdetails) . ' Keranjang ditemukan');

            return ResponseFormatter::error("Keranjang anda kosong", 400);
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCartRequest  $request
     * @return json
     */
    public function destroy(DeleteCartRequest $request)
    {
        try {
            if ($request->has('id')) {
                $cartDetail = CartDetail::whereHas('cart', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })->find($request->id);
                if (!$cartDetail) return ResponseFormatter::error('Tidak ada keranjang ditemukan', 400);

                $cartDetail->delete();

                return ResponseFormatter::success($cartDetail, 'Keranjang berhasil dihapus');
            } else {
                $cart = Cart::where('user_id', auth()->user()->id)->delete();

                return ResponseFormatter::success(['totalDeleted' => $cart], 'Keranjang berhasil dihapus');
            }
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
