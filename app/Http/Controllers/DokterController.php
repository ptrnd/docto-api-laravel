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
            return response([
                'status' => 'OK',
                'message' => 'Data Dokter Ditemukan',
                'data' => $dokter
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }

    public function getDokterById($id)
    {
        $dokter = DokterModel::where('id_dokter', $id)->get();
        if(count($dokter) > 0){
            return response([
                'status' => 'OK',
                'message' => 'Data Dokter Ditemukan',
                'data' => $dokter
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }

    public function insert_dokter(Request $request)
    {
        $dokter = new DokterModel;

        $dokter->nama_dokter = $request->nama;
        $dokter->spesialisasi = $request->spesialisasi;
        $dokter->alamat = $request->alamat;
        $dokter->telp = $request->telp;
        $dokter->nomor_str = $request->nomor_str;

        if($dokter->save()){
            return response([
                'status' => 'OK',
                'message' => 'Data Dokter Berhasil Disimpan',
                'data' => $dokter
            ], 200);
        } else {
            return response([
                'status' => 'Failed',
                'message' => 'Data Dokter Gagal Disimpan'
            ], 400);
        }
    }

    public function update_dokter(Request $request, $id)
    {
        $newNama = $request->nama;
        $newSpesialisasi = $request->spesialisasi;
        $newAlamat = $request->alamat;
        $newTelp = $request->telp;
        $newNomorStr = $request->nomor_str;
        
        $dokter = DokterModel::find($id);

        $dokter->nama_dokter = $newNama ? $newNama : $dokter->nama_dokter; 
        $dokter->spesialisasi = $newSpesialisasi ? $newSpesialisasi : $dokter->spesialisasi;
        $dokter->alamat = $newAlamat ? $newAlamat : $dokter->alamat;
        $dokter->telp = $newTelp ? $newTelp : $dokter->telp;
        $dokter->nomor_str = $newNomorStr ? $newNomorStr : $dokter->nomor_str;

        if($dokter->save()){
            return response([
                'status' => 'OK',
                'message' => 'Data Dokter Berhasil Disimpan',
                'data' => $dokter
            ], 200);
        } else {
            return response([
                'status' => 'Failed',
                'message' => 'Data Dokter Gagal Disimpan'
            ], 400);
        }
    }

    public function delete_dokter($id)
    {
        $dokter = DokterModel::where('id_dokter', $id);
        if ($dokter->delete()) {
            return response([
                'status' => 'OK',
                'message' => 'Data Dokter Berhasil Dihapus.'
            ], 200);
        } else{
            return response([
                'status' => 'Failed',
                'message' => 'Data Dokter Gagal Dihapus'
            ], 400);
        }
    }
}
