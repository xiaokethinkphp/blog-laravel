<?php

use Illuminate\Database\Seeder;

class CatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Cate::class, 20)->create();
    }
}
