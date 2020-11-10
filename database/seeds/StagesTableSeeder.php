<?php

use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //外部キー制約を無効化
        DB::table('stages')->truncate();// データのクリア、連番もリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //外部キー制約を有効化

        $param = [
            'stage_name' => 'アジフライスタジアム',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => '海女美術大学',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'アロワナモール',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'アンチョビットゲームズ',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'エンガワ河川敷',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ガンガゼ野外音楽堂',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'コンブトラック',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ザトウマーケット',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ショッツル鉱山',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'スメーシーワールド',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'タチウオパーキング',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'チョウザメ造船',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'デボン海洋博物館',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ハコフグ倉庫',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'バッテラストリート',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'Ｂバスパーク',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'フジツボスポーツクラブ',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ホッケふ頭',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ホテルニューオートロ',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'マンタマリア号',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'ムツゴ楼',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'モズク農園',
        ];
        DB::table('stages')->insert($param);
        $param = [
            'stage_name' => 'モンガラキャンプ場',
        ];
        DB::table('stages')->insert($param);        
    }
}
