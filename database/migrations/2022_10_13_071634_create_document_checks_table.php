<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id')->unsigned();
            $table->integer('kreativitas')->default(1);
            $table->integer('bidang_pkm')->default(1);
            $table->integer('kelengkapan_dokumen')->default(1);
            $table->integer('personalia_pendamping')->default(1);
            $table->integer('dana_pendamping')->default(1);
            $table->integer('luaran')->default(1);
            $table->integer('format_inti')->default(1);
            $table->integer('format_pendukung')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_checks');
    }
}
