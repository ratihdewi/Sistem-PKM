<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunAkademikIdColumnToActivityDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_documents', function (Blueprint $table) {
            $table->integer('tahun_akademik_id')->after('jenis_surat_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_documents', function (Blueprint $table) {
            $table->dropColumn('tahun_akademik_id');
        });
    }
}
