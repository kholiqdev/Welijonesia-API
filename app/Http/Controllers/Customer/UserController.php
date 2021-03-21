<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateUserRequest;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get data user
     *
     * @return json
     */
    public function index()
    {
        try {
            return ResponseFormatter::success(['user' => auth()->user()], 'Data user ditemukan');
        } catch (Exception $e) {
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
     * @param  UpdateUserRequest  $request
     * @return json
     */
    public function update(UpdateUserRequest $request)
    {
        try {
            $userArr = [];
            if ($request->has('name')) {
                $userArr['name'] = $request->name;
            }
            if ($request->has('gender')) {
                $userArr['gender'] = $request->gender;
            }
            if ($request->has('phone')) {
                $userArr['phone'] = $request->phone;
            }
            if (!empty($userArr)) {
                auth()->user()->update($userArr);
                return ResponseFormatter::success(['user' => auth()->user()], 'Profil berhasil diubah');
            }
            return ResponseFormatter::error('Gagal memperbarui profil', 400);
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
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
