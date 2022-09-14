<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\PKM\SkemaPKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterSkemaPKMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SkemaPKM::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pkm_id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validated();
        $data = SkemaPKM::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PKM\SkemaPKM  $skemaPKM
     * @return \Illuminate\Http\Response
     */
    public function show(SkemaPKM $skema_pkm)
    {
        return response()->json([
            'status' => 'success',
            'data' => $skema_pkm
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PKM\SkemaPKM  $skemaPKM
     * @return \Illuminate\Http\Response
     */
    public function edit(SkemaPKM $skema_pkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PKM\SkemaPKM  $skemaPKM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SkemaPKM $skema_pkm)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pkm_id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validated();
        $data = $skema_pkm->fill($validated);
        $data->save();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PKM\SkemaPKM  $skemaPKM
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkemaPKM $skema_pkm)
    {
        $skema_pkm->delete();

        return response()->json([
            'status' => 'success',
            'data' => null,
        ], 200);
    }
}
