<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadFileController extends Controller
{
    public function hasil_evaluasi($path, $file)
    {
        $filepath = public_path("documents/hasil_evaluasi/" . $path . "/" . $file);

        return Response::download($filepath);
    }

    public function dokumen_kegiatan($file)
    {
        $filepath = public_path("activity_documents/{$file}");

        return Response::download($filepath);
    }

    public function bukti_transaksi($file)
    {
        $filepath = public_path("documents/bukti_transaksi/{$file}");

        return Response::download($filepath);
    }
}
