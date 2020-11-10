<?php

use Illuminate\Database\Seeder;

class GachisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //外部キー制約を無効化
        DB::table('input_datas')->truncate();// データのクリア、連番もリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //外部キー制約を有効化

        $param = [
            'start_t' => '2000-01-01-00-00-00',
            'end_t' => '2000-01-01-02-00-00',
            'rule_id' => '1',
            'stage1_id' => '1',
            'stage2_id' => '2',
        ];
        DB::table('gachis')->insert($param);
    }
}
