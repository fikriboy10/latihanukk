<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index() {
        return view('login');
    }

    function login(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ],[
            'email.required'=>'Email Harus diisi',
            'password.required'=>'Password Harus diisi'
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)) {
           if(Auth::user()->role == 'administrator') {
            return redirect('/admin/administrator');
           } elseif (Auth::user()->role == 'petugas') {
            return redirect('/admin/petugas');
           } elseif (Auth::user()->role == 'pimpinan') {
            return redirect('/admin/pimpinan');
           } 
        } else {
            return redirect('')->withErrors('Email dan Password Salah')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
