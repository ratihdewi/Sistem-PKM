<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsColumnToDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->json('proposal_comments')->nullable()->after('status_laporan_akhir');
            $table->json('laporan_kemajuan_comments')->nullable()->after('proposal_comments');
            $table->json('laporan_akhir_comments')->nullable()->after('laporan_kemajuan_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('proposal_comments');
            $table->dropColumn('laporan_kemajuan_comments');
            $table->dropColumn('laporan_akhir_comments');
        });
    }
}
