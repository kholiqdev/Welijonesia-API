<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\PostFavoritRequest;
use App\Models\Favorit;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

class FavoritContoller extends Controller
{
    /**
     * Save or Update request from user.
     *
     * @param PostFavoritRequest $request
     * @return json
     */
    public function storeOrUpdate(PostFavoritRequest $request)
    {
        try {
            DB::beginTransaction();
            $favorit = Favorit::withTrashed()->where('user_id', auth()->user()->id)->where('seller_id', $request->seller_id)->first();

            if (!$favorit) {
                Favorit::updateOrCreate([
                    'user_id' => auth()->user()->id,
                    'seller_id' => $request->seller_id,
                ]);
            } else if ($favorit->trashed()) {
                $favorit->restore();
            } else {
                $favorit->delete();
            }

            $favorit = Favorit::where('seller_id', $request->seller_id)->count();

            Seller::where('id', $request->seller_id)->update([
                'favorit' => $favorit
            ]);
            DB::commit();
            return ResponseFormatter::success(['countFavorit' => $favorit], 'Berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
