<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetDistrictRequest;
use App\Models\District;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  GetDistrictRequest  $request
     * @return json
     */
    public function __invoke(GetDistrictRequest $request)
    {
        try {
            if ($request->has('id')) {
                $district = District::find($request->id);

                if ($district) return ResponseFormatter::success(['district' => $district], 'Kecamatan ditemukan');

                return ResponseFormatter::error("Kecamatan tidak ditemukan", 400);
            }
            $district = District::where('city_id', $request->city)->get();
            return ResponseFormatter::success(
                ['district' => $district],
                $district->count() . ' Kecamatan ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
