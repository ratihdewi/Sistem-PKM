<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanReviewerController extends Controller
{
    public function index()
    {
        $dosen = User::query()->userRoleId(2);

        $data_dosen = $dosen->get();
        $reviewers = $dosen->reviewer()->get();

        return view('page.admin.pengaturan_reviewer.index', compact('reviewers', 'data_dosen'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'dosen' => 'required',
        ]);

        User::where('id', (int) $request->dosen)->update(['is_reviewer' => 1]);

        return redirect(route('pengaturan-reviewer.index'));
    }

    public function delete($id)
    {
        User::where('id', $id)->update(['is_reviewer' => 0]);

        return redirect(route('pengaturan-reviewer.index'));
    }
}
