<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPKM extends Model
{
    use HasFactory;
    protected $table = 'master_jenis_pkm';
    protected $guarded = ['id'];
}
