<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaPKM extends Model
{
    use HasFactory;
    protected $table = 'master_skema_pkm';
    protected $guarded = ['id'];
    protected $with = ['jenis_pkm', 'documents'];
    protected $appends = ['jumlah_usulan'];

    public function jenis_pkm()
    {
        return $this->belongsTo('App\Models\Master\JenisPKM', 'jenis_pkm_id');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'skema_pkm_id');
    }

    public function getJumlahUsulanAttribute()
    {
        return $this->documents->count();
    }
}
