<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::orderBy('id', 'asc')->get();

        return view('page.admin.master.prodi.index', compact('prodi'));
    }
}
