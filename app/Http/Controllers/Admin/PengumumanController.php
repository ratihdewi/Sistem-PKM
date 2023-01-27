<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

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

        return redirect(route('index'));
    }
}
