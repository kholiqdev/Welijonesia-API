<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetAddressRequest;
use App\Http\Requests\Customer\PostAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetAddressRequest $request
     * @return json
     */
    public function index(GetAddressRequest $request)
    {
        try {
            if ($request->has('id')) {
                $address = Address::with(['user', 'village.district.city.province'])->find($request->id);

                if ($address) return ResponseFormatter::success(['address' => $address], 'Alamat ditemukan');

                return ResponseFormatter::error("Alamat tidak ditemukan", 400);
            }

            $address = Address::with(['user', 'village.district.city.province'])->where('user_id', auth()->user()->id)->get();
            return ResponseFormatter::success(
                ['address' => $address],
                $address->count() . ' alamat ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  PostAddressRequest  $request
     * @return json
     */
    public function store(PostAddressRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->status == 1) {
                Address::where('user_id', auth()->user()->id)->update([
                    'status' => 0
                ]);
            }

            $address = Address::create([
                'user_id' => auth()->user()->id,
                'village_id' => $request->village,
                'name' => $request->name,
                'address' => $request->address,
                'status' => $request->status,
            ]);

            DB::commit();
            return ResponseFormatter::success(['address' => $address], 'Berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage(), 400);
        }
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
