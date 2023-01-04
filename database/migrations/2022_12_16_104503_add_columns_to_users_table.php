<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('prodi_id')->after('id')->unsigned()->nullable();
            $table->string('nomor_induk')->after('name')->nullable();
            $table->string('position')->after('email')->nullable();
        });

        DB::table('users')->truncate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('prodi_id');
            $table->dropColumn('nomor_induk');
            $table->dropColumn('position');

            DB::table('users')->truncate();
        });
    }
}
