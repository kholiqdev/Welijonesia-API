<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  GetProvinceRequest  $request
     * @return json
     */
    public function __invoke(GetProvinceRequest $request)
    {
        try {
            if ($request->has('id')) {
                $province = Province::find($request->id);

                if ($province) return ResponseFormatter::success(['province' => $province], 'Provinsi ditemukan');

                return ResponseFormatter::error("Provinsi tidak ditemukan", 400);
            }
            $province = Province::all();
            return ResponseFormatter::success(
                ['province' => $province],
                $province->count() . ' provinsi ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
