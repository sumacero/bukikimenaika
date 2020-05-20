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
            $table->increments('input_data_id');
            $table->integer('user_id')->unsigned();
            $table->integer('rule_id')->unsigned();
            $table->integer('stage1_id')->unsigned();
            $table->integer('stage2_id')->unsigned();
            $table->integer('buki_id')->unsigned();
            $table->double('xp');
            $table->foreign('user_id')->references('user_id')->on('users'); // 外部キー参照
            $table->foreign('rule_id')->references('rule_id')->on('rules'); // 外部キー参照
            $table->foreign('stage1_id')->references('stage_id')->on('stages'); // 外部キー参照
            $table->foreign('stage2_id')->references('stage_id')->on('stages'); // 外部キー参照
            $table->foreign('buki_id')->references('buki_id')->on('bukis'); // 外部キー参照
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
