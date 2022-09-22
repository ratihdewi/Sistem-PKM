<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PKM\JenisPKM;
use App\Models\PKM\SkemaPKM;
use Illuminate\Http\Request;

class SkemaPKMController extends Controller
{
    public function index()
    {
        $skema_pkm = SkemaPKM::orderBy('id', 'asc')->get();

        return view('page.admin.skema_pkm.index', compact('skema_pkm'));
    }

    public function create()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.skema_pkm.create', compact('jenis_pkm'));
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

        return redirect(route('skema-pkm.index'));
    }

    public function show(SkemaPKM $skema_pkm)
    {
        //
    }

    public function edit(SkemaPKM $skema_pkm)
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.skema_pkm.update', compact('jenis_pkm', 'skema_pkm'));
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

        return redirect(route('skema-pkm.index'));
    }

    public function destroy(SkemaPKM $skema_pkm)
    {
        $skema_pkm->delete();

        return redirect(route('skema-pkm.index'));
    }
}
