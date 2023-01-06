<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDocument extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['jenis_surat', 'tahun_akademik'];

    public function jenis_surat()
    {
        return $this->belongsTo('App\Models\Master\JenisSurat', 'jenis_surat_id');
    }

    public function tahun_akademik()
    {
        return $this->belongsTo('App\Models\Master\TahunAkademik', 'tahun_akademik_id');
    }
}
