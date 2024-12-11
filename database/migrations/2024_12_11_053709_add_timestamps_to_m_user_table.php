<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToMUserTable extends Migration
{
    public function up()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->timestamps(); // Ini akan menambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}