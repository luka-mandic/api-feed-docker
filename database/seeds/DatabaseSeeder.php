<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'posts',
        'tags',
        'post_tag',
    ];

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        factory(App\Post::class, 30)->create();
        factory(App\Tag::class, 10)->create();

        $this->call(PostTagTableSeeder::class);
    }
}
