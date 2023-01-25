<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenis_surat = JenisSurat::orderBy('id', 'asc')->get();

        return view('page.admin.master.jenis_surat.index', compact('jenis_surat'));
    }
}
