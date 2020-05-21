<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //外部キー制約を無効化
        DB::table('rules')->truncate();// データのクリア、連番もリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //外部キー制約を有効化

        $param = [
            'rule_name' => 'ガチエリア',
        ];
        DB::table('rules')->insert($param);
        $param = [
            'rule_name' => 'ガチヤグラ',
        ];
        DB::table('rules')->insert($param);
        $param = [
            'rule_name' => 'ガチホコ',
        ];
        DB::table('rules')->insert($param);
        $param = [
            'rule_name' => 'ガチアサリ',
        ];
        DB::table('rules')->insert($param);
    }
}
