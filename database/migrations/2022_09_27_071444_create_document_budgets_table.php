<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id')->unsigned();
            $table->string('deskripsi_item');
            $table->string('jumlah');
            $table->string('harga_satuan');
            $table->string('bukti_transaksi');
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
        Schema::dropIfExists('document_budgets');
    }
}
