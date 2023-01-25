<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdReviewerColumnToDocumentOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_owners', function (Blueprint $table) {
            $table->json('id_reviewer')->after('id_anggota')->default(json_encode([]));
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
            $table->dropColumn('id_reviewer');
        });
    }
}
