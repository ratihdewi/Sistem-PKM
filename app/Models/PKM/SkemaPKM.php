<?php

namespace App\Models\PKM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaPKM extends Model
{
    use HasFactory;
    protected $table = 'skema_pkm';
    protected $guarded = ['id'];
    protected $with = ['jenis_pkm'];

    public function jenis_pkm()
    {
        return $this->belongsTo('App\Models\PKM\JenisPKM', 'jenis_pkm_id');
    }
}
