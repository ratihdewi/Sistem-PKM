<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentOwner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['data_mahasiswa', 'data_dosen', 'prodi_mahasiswa'];

    public function getDataMahasiswaAttribute()
    {
        $ids = json_decode($this->id_anggota);
        array_unshift($ids, $this->id_ketua);

        return User::whereIn('id', array_map('intval', $ids))->get(['nomor_induk', 'name']);
    }

    public function getDataDosenAttribute()
    {
        return User::where('id', $this->id_dosen)->first();
    }

    public function getProdiMahasiswaAttribute()
    {
        $ids = json_decode($this->id_anggota);
        array_unshift($ids, $this->id_ketua);

        $users = User::with('prodi')->whereIn('id', array_map('intval', $ids))->get()->pluck('prodi.name');

        return $users;
    }
}
