<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BukisTableSeeder::class);
        $this->call(StagesTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UdemaesTableSeeder::class);
        $this->call(GachisTableSeeder::class);
        $this->call(Input_datasTableSeeder::class);
    }
}
