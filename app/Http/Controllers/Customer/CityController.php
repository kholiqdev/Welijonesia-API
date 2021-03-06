<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetCityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  GetCityRequest  $request
     * @return json
     */
    public function __invoke(GetCityRequest $request)
    {
        try {
            if ($request->has('id')) {
                $city = City::find($request->id);

                if ($city) return ResponseFormatter::success(['city' => $city], 'Kota/Kabupaten ditemukan');

                return ResponseFormatter::error("Kota/Kabupaten tidak ditemukan", 400);
            }
            $city = City::where('province_id', $request->province)->get();
            return ResponseFormatter::success(
                ['city' => $city],
                $city->count() . ' Kota/Kabupaten ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
