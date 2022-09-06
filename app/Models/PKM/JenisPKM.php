<?php

namespace App\Models\PKM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPKM extends Model
{
    use HasFactory;
    protected $table = 'jenis_pkm';
    protected $guarded = ['id'];
}
