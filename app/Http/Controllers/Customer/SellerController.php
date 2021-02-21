<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetSellerRequest;
use App\Models\Seller;
use Illuminate\Database\QueryException;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetSellerRequest $request
     * @return json
     */
    public function index(GetSellerRequest $request)
    {
        try {
            if ($request->has('id')) {
                $seller = Seller::with(['user', 'rutedetails.rute'])->find($request->id);

                if ($seller) return ResponseFormatter::success(['seller' => $seller], 'Seller ditemukan');

                return ResponseFormatter::error("Seller tidak ditemukan", 400);
            }

            $seller = Seller::query();

            $seller->with(['user', 'rutedetails.rute'])->where('active', '=', 1);

            if ($request->has('type')) $seller->where('type', 'like', '%' . $request->type . '%');

            if ($request->has('rute')) $seller->whereHas('ruteDetails', function ($q) {
                $q->where('rute_id', request('rute'));
            });

            $limit = $request->input('limit', 6);

            return ResponseFormatter::success(
                ['seller' => $seller->paginate($limit)],

                $seller->count() . ' Seller ditemukan'
            );
        } catch (QueryException $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
