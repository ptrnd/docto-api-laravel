<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login($username, $password)
    {
        $user = UserModel::where(['username' => $username, 'password' => $password])->get();
        if(count($user) > 0){
            return response($user, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Ditemukan',
            //     'data' => $user
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }
}
