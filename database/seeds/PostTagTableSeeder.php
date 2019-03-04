<?php

use Illuminate\Database\Seeder;


class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 30; $i++) {
            DB::table('post_tag')->insert([
                'post_id' => rand(1, 30),
                'tag_id' => rand(1, 10)
            ]);
        }
    }
}
