<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdMahasiswaColumnInDocumentOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_owners', function (Blueprint $table) {
            $table->dropColumn('id_mahasiswa');
            $table->string('id_ketua')->after('id_dosen');
            $table->json('id_anggota')->after('id_ketua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_owners', function (Blueprint $table) {
            $table->json('id_mahasiswa')->after('id_dosen');
            $table->dropColumn('id_ketua');
            $table->dropColumn('id_anggota');
        });
    }
}
