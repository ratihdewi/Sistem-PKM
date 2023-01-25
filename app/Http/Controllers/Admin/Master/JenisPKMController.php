<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisPKM;
use Illuminate\Http\Request;

class JenisPKMController extends Controller
{
    public function index()
    {
        $jenis_pkm = JenisPKM::orderBy('id', 'asc')->get();

        return view('page.admin.master.jenis_pkm.index', compact('jenis_pkm'));
    }

    public function change_status(Request $request)
    {
        $jenis_pkm = JenisPKM::find((int) $request->item_id);
        $jenis_pkm->is_active = (int) $request->status;
        $jenis_pkm->save();

        return response()->json(['success' => 'Status changed successfully']);
    }
}
