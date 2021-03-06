<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetVillageRequest;
use App\Models\Village;

class VillageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  GetVillageRequest  $request
     * @return json
     */
    public function __invoke(GetVillageRequest $request)
    {
        try {
            if ($request->has('id')) {
                $village = Village::find($request->id);

                if ($village) return ResponseFormatter::success(['village' => $village], 'Desa/Kelurahan ditemukan');

                return ResponseFormatter::error("Desa/Kelurahan tidak ditemukan", 400);
            }
            $village = Village::where('district_id', $request->district)->get();
            return ResponseFormatter::success(
                ['village' => $village],
                $village->count() . ' Desa/Kelurahan ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
