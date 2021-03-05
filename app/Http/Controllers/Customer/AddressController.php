<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetAddressRequest $request
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
