<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisPKM;
use Illuminate\Http\Request;

class JenisPKMController extends Controller
{
    public function index()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.jenis_pkm.index', compact('jenis_pkm'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
