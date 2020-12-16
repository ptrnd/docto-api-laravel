<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingModel;

class BookingController extends Controller
{
    public function get_all_booking()
    {
        $booking = BookingModel::all();
        if(count($booking) > 0){
            return response($booking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Booking Ditemukan',
            //     'data' => $booking
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }

    public function getBookingById($id)
    {
        $booking = BookingModel::where('id_booking', $id)->get();
        if(count($booking) > 0){
            return response($booking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Booking Ditemukan',
            //     'data' => $booking
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }

    public function insert_booking(Request $request)
    {
        $insert_booking = new BookingModel;

        $insert_booking->id_user = $request->id_user;
        $insert_booking->id_dokter = $request->id_dokter;
        $insert_booking->tanggal = $request->tanggal;

        if($insert_booking->save()){
            return response($insert_booking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Booking Berhasil Disimpan',
            //     'data' => $insert_booking
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Booking Gagal Disimpan'
            // ], 400);
        }
    }

    public function update_booking(Request $request, $id)
    {
        $newIdUser = $request->id_user;
        $newIdDokter = $request->id_dokter;
        $newTanggal = $request->tanggal;
        
        $booking = BookingModel::find($id);
            
        $booking->id_user = $newIdUser ? $newIdUser : $booking->id_user;
        $booking->id_dokter = $newIdDokter ? $newIdDokter : $booking->id_dokter;
        $booking->tanggal = $newTanggal ? $newTanggal : $booking->tanggal;

        if($booking->save()){
            return response($booking, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Booking berhasil Disimpan',
            //     'data' => $booking
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Booking Gagal Disimpan'
            // ], 400);
        }
    }

    public function delete_booking($id)
    {
        $booking = BookingModel::where('id_booking', $id);
        if($booking->delete()){
            return response(200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Booking Berhasil Dihapus'
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Booking Gagal Dihapus'
            // ], 400);
        }
    }
}
