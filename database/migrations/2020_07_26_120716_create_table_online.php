<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOnline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->nullable();;
            $table->string('name')->nullable();;
            $table->string('money')->nullable();;
            $table->integer('code')->nullable();;
            $table->Text('content')->nullable();;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('online', function (Blueprint $table) {
            //
        });
    }
}
