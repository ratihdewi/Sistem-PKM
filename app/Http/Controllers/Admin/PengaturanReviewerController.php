<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanReviewerController extends Controller
{
    public function index()
    {
        $reviewers = User::where('role_id', 2)->where('is_reviewer', 1)->get();

        return view('page.admin.pengaturan_reviewer.index', compact('reviewers'));
    }

    public function create()
    {
        $data_dosen = User::where('role_id', 2)->get();

        return view('page.admin.pengaturan_reviewer.create', compact('data_dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen' => 'required',
        ]);

        User::where('id', (int) $request->dosen)->update(['is_reviewer' => 1]);

        return redirect(route('pengaturan-reviewer.index'));
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
        User::where('id', $id)->update(['is_reviewer' => 0]);

        return redirect(route('pengaturan-reviewer.index'));
    }
}
