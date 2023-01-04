<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadBuktiTransaksiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($file)
    {
        $filepath = public_path("documents/bukti_transaksi/{$file}");

        return Response::download($filepath);
    }
}
