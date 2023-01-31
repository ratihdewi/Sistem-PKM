<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $tahun_akademik = TahunAkademik::orderBy('id', 'asc')->get();

        return view('page.admin.master.tahun_akademik.index', compact('tahun_akademik'));
    }

    public function create()
    {
        return view('page.admin.master.tahun_akademik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required',
            'term' => 'required'
        ]);

        TahunAkademik::create($validated);

        return redirect(route('tahun-akademik.index'))->with('success', 'Tahun akademik berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit(TahunAkademik $tahun_akademik)
    {
        return view('page.admin.master.tahun_akademik.update', compact('tahun_akademik'));
    }

    public function update(Request $request, TahunAkademik $tahun_akademik)
    {
        $validated = $request->validate([
            'tahun' => 'required',
            'term' => 'required'
        ]);

        $tahun_akademik->fill($validated);
        $tahun_akademik->save();

        return redirect(route('tahun-akademik.index'))->with('success', 'Tahun akademik berhasil diubah');
    }

    public function destroy(TahunAkademik $tahun_akademik)
    {
        $tahun_akademik->delete();

        return redirect(route('tahun-akademik.index'))->with('success', 'Tahun akademik berhasil dihapus');
    }
}
