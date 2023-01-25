<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentOwner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['data_mahasiswa', 'data_dosen', 'data_reviewer'];

    public function getDataMahasiswaAttribute()
    {
        $ids = json_decode($this->id_anggota);
        array_unshift($ids, $this->id_ketua);

        return User::whereIn('id', array_map('intval', $ids))->get();
    }

    public function getDataDosenAttribute()
    {
        return User::where('id', $this->id_dosen)->first();
    }

    public function getDataReviewerAttribute()
    {
        return User::whereIn('id', array_map('intval', json_decode($this->id_reviewer)))->get();
    }
}
