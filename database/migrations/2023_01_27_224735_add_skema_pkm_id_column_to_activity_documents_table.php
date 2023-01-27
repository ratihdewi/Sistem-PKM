<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkemaPkmIdColumnToActivityDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_documents', function (Blueprint $table) {
            $table->integer('skema_pkm_id')->after('tahun_akademik_id')->unsigned()->nullable();
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
            $table->dropColumn('skema_pkm_id');
        });
    }
}
