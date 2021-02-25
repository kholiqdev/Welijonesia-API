<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  GetProductRequest  $request
     * @return json
     */
    public function __invoke(GetProductRequest $request)
    {
        try {
            if ($request->has('id')) {
                $product = Product::with(['seller', 'comodity', 'productdetails.productunit'])->find($request->id);

                if ($product) return ResponseFormatter::success(['product' => $product], 'Product ditemukan');

                return ResponseFormatter::error("Seller tidak ditemukan", 400);
            }

            $product = Product::query();
            $product->with(['seller', 'comodity', 'productdetails.productunit'])->where('seller_id', '=', $request->seller_id);

            if ($request->has('seller_id')) $product->where('seller_id', $request->seller_id);


            $limit = $request->input('limit', 6);

            return ResponseFormatter::success(
                ['product' => $product->paginate($limit)],
                $product->count() . ' produk ditemukan'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
