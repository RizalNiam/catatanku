<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;


class UserController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $input = request(['phone', 'password']);
        $device_token = request('device_token');

        if (!$token = auth("api")->attempt($input)) {
            return response()->json(['message' => 'Nomor Telepon atau Kata Sansi yang anda masukan tidak valid, silahkan coba lagi'], 401);
        }

        $user = auth("api")->user();
    
        DB::table('users')
              ->where('id', $user->id)
              ->update(['device_token' => $device_token]);
    
        $data = DB::table('users')
            ->join('schools', 'users.school_id', '=', 'schools.id')
            ->select('users.id', 'users.name', 'users.phone', 'users.photo', 'users.created_at', 'users.updated_at', 'schools.id as school_id', 'schools.school_name as school_name')
            ->where('users.id', '=', $user->id)
            ->get();

        return $this->loginSuccess($data[0], $token);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
