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
        $price = [5000, 10000, 15000, 20000];
        $tempis = ['Kubah Mas', 'Baturaden', 'Tancak Kembar', 'Teluk Love'];
        // $this->call(UsersTableSeeder::class);
        for ($i=0; $i < 4; $i++) {
            DB::table('destinations')->insert([
                'name' => $tempis[$i],
                'price' => $price[rand(0,3)],
            ]);
        }
    }
}
