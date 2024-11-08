<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = "konsumen";  // Sesuaikan dengan nama tabel yang benar

    // Menentukan primary key
    protected $primaryKey = "id";

    // Jika 'id' bukan auto-increment dan bukan integer
    public $incrementing = true;  // Jika id adalah auto-increment, set ke true
    protected $keyType = 'int';   // Pastikan tipe primary key sesuai, misalnya 'int'

    // Field yang bisa diisi
    protected $fillable = [
        'id',
        'nama',
        'no_telp',
        'alamat',
    ];

    // Field yang disembunyikan
    protected $hidden = [
        'password',  // Jika ada kolom 'password' pada tabel, pastikan sudah di-handle
        'remember_token',  // Jika menggunakan fitur token untuk sesi login
    ];

    // Cast attribute ke tipe data tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',  // Hanya jika kolom ini ada
        'password' => 'hashed',  // Jika kolom 'password' ada, gunakan hash
    ];
}
