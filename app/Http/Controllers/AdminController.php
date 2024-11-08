<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index(){
       return view('dashboard.welcome');
    }
    public function administrator(){
        return view('dashboard.dashboardadmin');
    }
    function petugas(){
        echo "Selamat Datang di Halaman Petugas";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'> Logout>>> </a>";
    }
    function pimpinan(){
        echo "Selamat Datang di Halaman Pimpinan";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'> Logout>>> </a>";
    }

   
}
