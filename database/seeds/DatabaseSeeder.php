<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'MainCategory',
            'parent_id' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
