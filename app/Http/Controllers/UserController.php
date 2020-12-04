<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function get_all_user()
    {
        $user = UserModel::all();
        if(count($user) > 0){
            return response([
                'status' => 'OK',
                'message' => 'User Ditemukan',
                'data' => $user
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
        // return response()->json(UserModel::all(), 200);
    }

    public function getUserById($id)
    {
        $user = UserModel::where('id_user', $id)->get();
        if(count($user) > 0){
            return response([
                'status' => 'OK',
                'message' => 'User Ditemukan',
                'data' => $user
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }

    public function insert_user(Request $request)
    {
        $insert_user = new UserModel;

        $insert_user->nama_user = $request->nama;
        $insert_user->email = $request->email;
        $insert_user->username = $request->username;
        $insert_user->password = $request->password;
        $insert_user->telp = $request->telp;
        $insert_user->alamat = $request->alamat;
        
        if($insert_user->save()){
            return response([
                'status' => 'OK',
                'message' => 'User Disimpan',
                'data' => $insert_user
            ], 200);
        } else {
            return response([
                'status' => 'Failed',
                'message' => 'User Gagal Disimpan'
            ], 400);
        }
    }

    public function update_user(Request $request, $id)
    {
        $newNamaUser = $request->nama;
        $newEmail = $request->email;
        $newUsername = $request->username;
        $newPassword = $request->password;
        $newTelp = $request->telp;
        $newAlamat = $request->alamat;
        
        $data_user = UserModel::find($id);

        $data_user->nama_user = $newNamaUser ? $newNamaUser : $data_user->nama_user;
        $data_user->email = $newEmail ? $newEmail : $data_user->email;
        $data_user->username = $newUsername ? $newUsername : $data_user->username;
        $data_user->password = $newPassword ? $newPassword : $data_user->password;
        $data_user->telp = $newTelp ? $newTelp : $data_user->telp;
        $data_user->alamat = $newAlamat ? $newAlamat : $data_user->alamat;

        if($data_user->save()){
            return response([
                'status' => 'OK',
                'message' => 'User Berhasil Disimpan',
                'update-data' => $data_user
            ], 200);
        } else {
            return response([
                'status' => 'Failed',
                'message' => 'User Gagal Disimpan'
            ], 400);
        }
    }

    public function delete_user($id)
    {
        $user = UserModel::where('id_user', $id);
        if($user->delete()){
            return response([
                'status' => 'OK',
                'message' => 'User Dihapus'
            ], 200);
        } else {
            return response([
                'status' => 'Failed',
                'message' => 'Data Gagal Dihapus'
            ], 400);
        }
    }
}
