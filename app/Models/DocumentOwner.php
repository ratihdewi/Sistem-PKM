<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentOwner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['data_mahasiswa', 'data_dosen'];

    public function getDataMahasiswaAttribute()
    {
        $users = User::whereIn('id', array_map('intval', json_decode($this->id_mahasiswa)))->get(['nomor_induk', 'name']);

        return $users;
    }

    public function getDataDosenAttribute()
    {
        return User::where('id', $this->id_dosen)->first();
    }
}
