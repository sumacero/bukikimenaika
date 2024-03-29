<?php

use Illuminate\Database\Seeder;

class Input_datasTableSeeder extends Seeder
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
            'user_id' => '1',
            'gachi_id' => '1',
            'buki_id' => '1',
            'udemae_id' => '1',
            'xp' => '1000',
            'created_at' => now(),
            'updated_at' => now(),
            'win' => null,
            'lose' => null,
            'comment' => null,
        ];
        DB::table('input_datas')->insert($param);
    }
}
