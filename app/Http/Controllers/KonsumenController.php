<?php

namespace App\Http\Controllers;


use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KonsumenController extends Controller
{
    public function index(Request $request) {
        $query = Konsumen::query();
        $query->select('konsumen.*');
        $query->orderBy('nama');
        if (!empty($request->nama_konsumen)) {
            $query->where('nama', 'like', '%' . $request->nama_konsumen . '%');
        }
            $konsumen = $query->paginate(1);
        return view('konsumen.index', compact('konsumen'));
    }
   
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'nama' => 'required|string|unique:konsumen|max:255', // Mengubah validasi 'numeric' menjadi 'string'
        'alamat' => 'required|string|max:255',
        'no_telp' => 'required|numeric',
    ]);

    // Collect input data
    $nama = $request->nama;
    $alamat = $request->alamat;
    $no_telp = $request->no_telp;
   

    // Try to store the data
    try {
        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
           
        ];

        DB::table('konsumen')->insert($data);

        return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            $message = $e->getCode() == 23000 ? "Data dengan nama " . $nama . " sudah ada" : $e->getMessage();
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan. ' . $message]);
        }
    }
    public function edit(Request $request)
    {
        // Validate input
        $request->validate([
            'nama' => 'required|numeric',
        ]);
    
        // Retrieve data based on 'nis'
        $nama = $request->nama;   
        $konsumen = DB::table('konsumen')->where('nama', $nama)->first();
    
        if (!$konsumen) {
            return Redirect::back()->with(['warning' => 'Data Anggota Tidak Ditemukan']);
        }
    
        return view('konsumen.edit', compact('konsumen'));
    }
    
    public function update($nama, Request $request)
    {
    $nama = $request->nama;
    $alamat = $request->alamat;
    $no_telp = $request->no_telp;  
   

    try {
        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
           
        ];

        $update = DB::table('konsumen')->where('nama', $nama)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    } catch (\Exception $e) {
        return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($nama)
    {
        $delete = DB::table('konsumen')->where('nama', $nama)->first();
        if ($delete) {
            $delete = DB::table('konsumen')->where('nama', $nama)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }


}
