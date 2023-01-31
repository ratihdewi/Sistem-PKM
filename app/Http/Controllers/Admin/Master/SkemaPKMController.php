<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisPKM;
use App\Models\Master\SkemaPKM;
use Illuminate\Http\Request;

class SkemaPKMController extends Controller
{
    public function index()
    {
        $skema_pkm = SkemaPKM::with('jenis_pkm')->orderBy('id', 'asc')->get();

        return view('page.admin.master.skema_pkm.index', compact('skema_pkm'));
    }

    public function create()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.master.skema_pkm.create', compact('jenis_pkm'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pkm' => 'required',
            'skema_pkm' => 'required'
        ]);

        $validated['jenis_pkm_id'] = $request->jenis_pkm;
        $validated['name'] = $request->skema_pkm;

        SkemaPKM::create($validated);

        return redirect(route('skema-pkm.index'))->with('success', 'Skema PKM berhasil ditambahkan');
    }

    public function show(SkemaPKM $skema_pkm)
    {
        //
    }

    public function edit(SkemaPKM $skema_pkm)
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.master.skema_pkm.update', compact('jenis_pkm', 'skema_pkm'));
    }

    public function update(Request $request, SkemaPKM $skema_pkm)
    {
        $validated = $request->validate([
            'jenis_pkm' => 'required',
            'skema_pkm' => 'required'
        ]);

        $validated['jenis_pkm_id'] = $request->jenis_pkm;
        $validated['name'] = $request->skema_pkm;

        $skema_pkm->fill($validated);
        $skema_pkm->save();

        return redirect(route('skema-pkm.index'))->with('success', 'Skema PKM berhasil diubah');
    }

    public function destroy(SkemaPKM $skema_pkm)
    {
        $skema_pkm->delete();

        return redirect(route('skema-pkm.index'))->with('success', 'Skema PKM berhasil dihapus');
    }
}
