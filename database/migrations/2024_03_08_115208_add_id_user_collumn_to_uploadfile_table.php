<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploadfile', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->after('upload_path');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploadfile', function (Blueprint $table) {
            $table->dropForeign('uploadfile_id_user_foreign');
            $table->dropColumn('id_user');

        });
    }
};
