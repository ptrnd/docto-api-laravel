<?php

namespace App\Http\Controllers;

use App\Models\BookingModel;
use App\Models\DokterModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function get_all_user()
    {
        $user = UserModel::all();
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
        // return response()->json(UserModel::all(), 200);
    }

    public function getUserById($id)
    {
        $user = UserModel::where('id_user', $id)->get();
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

    public function getUserBooking($id)
    {
        $userBooking = BookingModel::where('id_user', $id)->get();
        if(count($userBooking) > 0){
            return response($userBooking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Ditemukan',
            //     'data' => $userBooking
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }

    public function getUserBookingHistory($id)
    {
        //mysql
        // $userBooking = DB::table('booking AS b')
        //                     ->select(DB::raw('b.id_user AS id_user,
        //                             DATE_FORMAT(b.tanggal, "%d-%m-%Y") AS tanggal,
        //                             d.id_dokter AS id_dokter,
        //                             d.nama_dokter AS nama_dokter,
        //                             d.alamat AS alamat,
        //                             d.spesialisasi AS spesialisasi, 
        //                             d.telp AS telp'))
        //                     ->join('dokter AS d', 'd.id_dokter', '=', 'b.id_dokter')
        //                     ->where('b.id_user', $id)
        //                     ->orderByDesc('b.tanggal')
        //                     ->get();

        //postgresql
        $userBooking = BookingModel::select('b.id_user AS id_user',
                                    'b.tanggal AS tanggal',
                                    'd.id_dokter AS id_dokter',
                                    'd.nama_dokter AS nama_dokter',
                                    'd.alamat AS alamat',
                                    'd.spesialisasi AS spesialisasi', 
                                    'd.telp AS telp')
                            ->join('dokter AS d', 'd.id_dokter', '=', 'b.id_dokter')
                            ->where('b.id_user', $id)
                            ->orderByDesc('b.tanggal')
                            ->get();

        if(count($userBooking) > 0){
            return response($userBooking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Ditemukan',
            //     'data' => $userBooking
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
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
            return response($insert_user, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Disimpan',
            //     'data' => $insert_user
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'User Gagal Disimpan'
            // ], 400);
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
            return response($data_user, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Berhasil Disimpan',
            //     'update-data' => $data_user
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'User Gagal Disimpan'
            // ], 400);
        }
    }

    public function delete_user($id)
    {
        $user = UserModel::where('id_user', $id);
        if($user->delete()){
            return response(200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'User Dihapus'
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Gagal Dihapus'
            // ], 400);
        }
    }
}
