<?php

namespace App\Models\Master;

use App\Models\DocumentOwner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'master_prodi';
    protected $guarded = ['id'];
    protected $appends = ['jumlah_usulan', 'jumlah_peserta'];

    public function getJumlahUsulanAttribute()
    {
        $documents = DocumentOwner::all();
        $documents = $documents->filter(function ($item) {
            return $item->data_mahasiswa->contains('prodi_id', $this->id);
        })->values();

        return $documents->count();
    }

    public function getJumlahPesertaAttribute()
    {
        $documents = DocumentOwner::all();
        $ids = [];

        foreach ($documents as $document) {
            $id_mahasiswa = json_decode($document->id_anggota);
            array_unshift($id_mahasiswa, $document->id_ketua);

            foreach ($id_mahasiswa as $id) {
                array_push($ids, (int) $id);
            }
        }

        $ids = array_values(array_unique($ids));

        return User::whereIn('id', $ids)->where('prodi_id', $this->id)->count();
    }
}
