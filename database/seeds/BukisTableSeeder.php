<?php

use Illuminate\Database\Seeder;

class BukisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //外部キー制約を無効化
        DB::table('bukis')->truncate();// データのクリア、連番もリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //外部キー制約を有効化
        
        $param = [
            'buki_name' => 'スプラシューター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラシューターコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローシューター レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'オクタシューター レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラシューターベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プライムシューター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プライムシューターコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プライムシューターベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'シャープマーカー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'シャープマーカーネオ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'わかばシューター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'もみじシューター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'おちばシューター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プロモデラーMG',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プロモデラーRG',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'プロモデラーPG',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'N-ZAP85',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'N-ZAP89',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'N-ZAP83',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '.52ガロン',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '.52ガロンデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '.52ガロンベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ジェットスイーパー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ジェットスイーパーカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'L3リールガン',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'L3リールガンD',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'L3リールガンベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '.96ガロン',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '.96ガロンデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'H3リールガン',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'H3リールガンD',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'H3リールガンチェリー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ボールドマーカー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ボールドマーカーネオ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ボールドマーカー7',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ボトルガイザー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ボトルガイザーフォイル',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ホットブラスター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ホットブラスターカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローブラスター レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ラピッドブラスター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ラピッドブラスターデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ラピッドブラスターベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ノヴァブラスター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ノヴァブラスターネオ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ノヴァブラスターベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クラッシュブラスター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クラッシュブラスターネオ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'Rブラスターエリート',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'Rブラスターエリートデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ロングブラスター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ロングブラスターカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ロングブラスターネクロ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラローラー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラローラーコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローローラー レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラローラーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ダイナモローラー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ダイナモローラーテスラ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ダイナモローラーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'カーボンローラー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'カーボンローラーデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヴァリアブルローラー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヴァリアブルローラーフォイル',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ホクサイ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローブラシ レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ホクサイ・ヒュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ホクサイベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'パブロ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'パブロ・ヒュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'パーマネント・パブロ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラチャージャー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスコープ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラチャージャーコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスコープコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローチャージャー レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラチャージャーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスコープベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'リッター4K',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '4Kスコープ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'リッター4Kカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '4Kスコープカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ソイチューバー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ソイチューバーカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクイックリンα',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクイックリンβ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクイックリンγ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '14式竹筒銃・甲',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '14式竹筒銃・乙',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => '14式竹筒銃・丙',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バケットスロッシャー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーロースロッシャー レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バケットスロッシャーデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バケットスロッシャーソーダ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒッセン',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒッセン・ヒュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクリュースロッシャー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクリュースロッシャーネオ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スクリュースロッシャーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'エクスプロッシャー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'エクスプロッシャーカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'オーバーフロッシャー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'オーバーフロッシャーデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バレルスピナー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーロースピナー レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バレルスピナーデコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'バレルスピナーリミックス',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスピナー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスピナーコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラスピナーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ハイドラント',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ハイドラントカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クーゲルシュライバー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クーゲルシュライバー・ヒュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ノーチラス47',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ノーチラス79',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラマニューバー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラマニューバーコラボ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローマニューバー レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スプラマニューバーベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパッタリー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパッタリー・ヒュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパッタリークリア',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'デュアルスイーパー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'デュアルスイーパーカスタム',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ケルビン525',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ケルビン525デコ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ケルビン525ベッチュー',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クアッドホッパーブラック',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'クアッドホッパーホワイト',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'パラシェルター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'ヒーローシェルター レプリカ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'パラシェルターソレーラ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'キャンピングシェルター',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'キャンピングシェルターソレーラ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'キャンピングシェルターカーモ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパイガジェット',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパイガジェットソレーラ',
        ];
        DB::table('bukis')->insert($param);
        $param = [
            'buki_name' => 'スパイガジェットベッチュー',
        ];
    }
}
