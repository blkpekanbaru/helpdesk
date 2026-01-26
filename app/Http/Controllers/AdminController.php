<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function pekerjaan(){
        return view('admin.pekerjaan.tampil_data');
    }

    public function pelatihan(){
        return view('admin.pelatihan.tampil_data');
    }

    public function laporan(){
        return view('admin.laporan.laporan');
    }
}
