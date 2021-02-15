<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      // Envoyer les nouvelles données : php artisan db:seed

        // \App\Models\User::factory(10)->create();

        DB::table("users")->insert([
          "name" => "test",
          "email" => "test@gmail.com",
          "password" => bcrypt("1234")
        ]);
        DB::table("users")->insert([
          "name" => "test2",
          "email" => "test2@gmail.com",
          "password" => bcrypt("1234")
        ]);

        DB::table('songs')->insert([
          "title" => 'chanson 1',
          'url' => 'https://file-examples-com.github.io/uploads/2017/11/file_example_MP3_700KB.mp3',
          'votes' => 1350,
          'user_id' => 1
        ]);

        DB::table('songs')->insert([
          "title" => 'chanson n°2',
          'url' => 'https://filesamples.com/samples/audio/mp3/sample2.mp3',
          'votes' => 10050,
          'user_id' => 1
        ]);
        DB::table('songs')->insert([
          "title" => 'chanson n°3',
          'url' => 'https://filesamples.com/samples/audio/mp3/sample2.mp3',
          'votes' => 10050,
          'user_id' => 2
        ]);
    }
}
