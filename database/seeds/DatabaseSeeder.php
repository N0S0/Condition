<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    // $this->call(UsersTableSeeder::class);

    DB::table('users')->insert([
      'name' => "guest",
      'email' => 'guest@gmail.com',
      'password' => Hash::make('guest2020'),
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('users')->insert([
      'name' => "admin",
      'email' => 'admin@gmail.com',
      'password' => Hash::make('admin2020'),
      'created_at' => '2020-12-05 00:00:00',
    ]);
  }
}
