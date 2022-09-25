<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanReviewerController extends Controller
{
    public function index()
    {
        return view('page.admin.pengaturan_reviewer.index');
    }

    public function create()
    {
        return view('page.admin.pengaturan_reviewer.create');
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
