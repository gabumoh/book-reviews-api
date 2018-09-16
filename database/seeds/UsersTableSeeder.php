<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clear the user table first
      User::truncate();

      $faker = \Faker\Factory::create();

      // Let's make sure everyone has the same password and
      // let's hash it before the loop, or else our seeder
      // will be too slow.
      $password = Hash::make('password');

      User::create([
        'name' => 'Administrator',
        'email' => 'admin@test.com',
        'password' => $password,
      ]);

      for ($i = 0; $i < 10; $i++) {
        User::create([
          'name' => $faker->name,
          'email' => $faker->email,
          'password' => $password,
        ]);
      }

    }
}
