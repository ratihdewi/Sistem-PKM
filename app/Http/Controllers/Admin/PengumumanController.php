<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
    public function create()
    {
        return view('page.admin.pengumuman.create');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'announcement' => 'required'
        ]);

        $validated['text'] = $request->announcement;
        Announcement::create($validated);

        return redirect(route('pengumuman.index'))->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function index()
    {
        $data['data'] = Announcement::orderBy('id', 'asc')->get();

        return view('page.admin.pengumuman.index', $data);
    }

    public function edit($id)
    {
        $data['data'] = Announcement::findOrFail($id);
        return view('page.admin.pengumuman.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $announce = Announcement::find($id);

        $announce->fill($data);
        $announce->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Announcement::find($id)->delete();
        return redirect()->route('pengumuman.index');
    }
}
