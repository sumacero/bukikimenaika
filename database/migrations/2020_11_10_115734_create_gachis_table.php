<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGachisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gachis', function (Blueprint $table) {
            $table->bigIncrements('gachi_id');
            $table->timestamp('start_t')->useCurrent()->nullable()->unique();
            $table->timestamp('end_t')->useCurrent()->nullable()->unique();;
            $table->bigInteger('rule_id')->unsigned();
            $table->bigInteger('stage1_id')->unsigned();
            $table->bigInteger('stage2_id')->unsigned();
            $table->foreign('rule_id')->references('rule_id')->on('rules'); // 外部キー参照
            $table->foreign('stage1_id')->references('stage_id')->on('stages'); // 外部キー参照
            $table->foreign('stage2_id')->references('stage_id')->on('stages'); // 外部キー参照
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gachis');
    }
}
