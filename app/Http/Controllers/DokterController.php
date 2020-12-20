<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function get_all_dokter()
    {
        $dokter = DokterModel::all();
        if (count($dokter)) {
            return response($dokter, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Dokter Ditemukan',
            //     'data' => $dokter
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }

    public function getDokterById($id)
    {
        $dokter = DokterModel::where('id_dokter', $id)->get();
        if(count($dokter) > 0){
            return response($dokter, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Dokter Ditemukan',
            //     'data' => $dokter
            // ], 200);
        } else {
            return response(404);
            // return response([
            //     'status' => 'Not Found',
            //     'message' => 'Data Tidak Ditemukan'
            // ], 404);
        }
    }

    public function getDokterByKey($key)
    {
        $dokter = DokterModel::where('nama_dokter', 'LIKE', "%{$key}%") 
                            ->orWhere('spesialisasi', 'LIKE', "%{$key}%") 
                            ->orWhere('alamat', 'LIKE', "%{$key}%")
                            ->get();
        if(count($dokter) > 0){
            return response($dokter, 200);
        } else {
            return response(404);
        }
    }

    public function insert_dokter(Request $request)
    {
        $dokter = new DokterModel;

        $dokter->nama_dokter = $request->nama;
        $dokter->spesialisasi = $request->spesialisasi;
        $dokter->alamat = $request->alamat;
        $dokter->telp = $request->telp;
        $dokter->keterangan = $request->keterangan;

        if($dokter->save()){
            return response($dokter, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Dokter Berhasil Disimpan',
            //     'data' => $dokter
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Dokter Gagal Disimpan'
            // ], 400);
        }
    }

    public function update_dokter(Request $request, $id)
    {
        $newNama = $request->nama;
        $newSpesialisasi = $request->spesialisasi;
        $newAlamat = $request->alamat;
        $newTelp = $request->telp;
        $newKeterangan = $request->keterangan;
        
        $dokter = DokterModel::find($id);

        $dokter->nama_dokter = $newNama ? $newNama : $dokter->nama_dokter; 
        $dokter->spesialisasi = $newSpesialisasi ? $newSpesialisasi : $dokter->spesialisasi;
        $dokter->alamat = $newAlamat ? $newAlamat : $dokter->alamat;
        $dokter->telp = $newTelp ? $newTelp : $dokter->telp;
        $dokter->keterangan = $newKeterangan ? $newKeterangan : $dokter->keterangan;

        if($dokter->save()){
            return response($dokter, 200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Dokter Berhasil Disimpan',
            //     'data' => $dokter
            // ], 200);
        } else {
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Dokter Gagal Disimpan'
            // ], 400);
        }
    }

    public function delete_dokter($id)
    {
        $dokter = DokterModel::where('id_dokter', $id);
        if ($dokter->delete()) {
            return response(200);
            // return response([
            //     'status' => 'OK',
            //     'message' => 'Data Dokter Berhasil Dihapus.'
            // ], 200);
        } else{
            return response(400);
            // return response([
            //     'status' => 'Failed',
            //     'message' => 'Data Dokter Gagal Dihapus'
            // ], 400);
        }
    }
}
