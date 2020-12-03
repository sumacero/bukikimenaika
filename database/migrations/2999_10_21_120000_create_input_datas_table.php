<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_datas', function (Blueprint $table) {
            $table->bigIncrements('input_data_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('gachi_id')->unsigned();
            $table->bigInteger('buki_id')->unsigned();
            $table->bigInteger('udemae_id')->unsigned();
            $table->double('xp');
            $table->integer('win')->unsigned()->nullable();
            $table->integer('lose')->unsigned()->nullable();
            $table->string('comment',100)->nullable();
            $table->foreign('user_id')->references('id')->on('users'); // 外部キー参照
            $table->foreign('gachi_id')->references('gachi_id')->on('gachis'); // 外部キー参照
            $table->foreign('buki_id')->references('buki_id')->on('bukis'); // 外部キー参照
            $table->foreign('udemae_id')->references('udemae_id')->on('udemaes'); // 外部キー参照
            $table->timestamps(); // タイムスタンプ列を追加
            $table->unique(['user_id', 'gachi_id']); //ユニーク設定
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_datas');
    }
}
