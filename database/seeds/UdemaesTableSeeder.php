<?php

use Illuminate\Database\Seeder;

class UdemaesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //外部キー制約を無効化
        DB::table('udemaes')->truncate();// データのクリア、連番もリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //外部キー制約を有効化

        $param = [
            'udemae_name' => 'C-',
            'xp' => '1000',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'C',
            'xp' => '1100',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'C+',
            'xp' => '1200',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'B-',
            'xp' => '1300',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'B',
            'xp' => '1400',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'B+',
            'xp' => '1500',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'A-',
            'xp' => '1600',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'A',
            'xp' => '1700',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'A+',
            'xp' => '1800',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S',
            'xp' => '1900',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+0',
            'xp' => '2000',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+1',
            'xp' => '2010',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+2',
            'xp' => '2020',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+3',
            'xp' => '2030',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+4',
            'xp' => '2040',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+5',
            'xp' => '2050',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+6',
            'xp' => '2060',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+7',
            'xp' => '2070',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+8',
            'xp' => '2080',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'S+9',
            'xp' => '2090',
        ];
        DB::table('udemaes')->insert($param);
        $param = [
            'udemae_name' => 'X',
            'xp' => '2100',
        ];
        DB::table('udemaes')->insert($param);
    }
}
