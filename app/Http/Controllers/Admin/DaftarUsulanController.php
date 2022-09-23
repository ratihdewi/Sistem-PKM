<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarUsulanController extends Controller
{
    public function index()
    {
        return view('page.admin.daftar_usulan.index');
    }
}
