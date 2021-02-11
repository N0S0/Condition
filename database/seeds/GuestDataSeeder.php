<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class GuestDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-12-05 00:00:00',
      'taion' => 36.6,
      'comment' => '特に異常なし',
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-12-6 00:00:00',
      'taion' => 36.6,
      'condition' => '1',
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-12-07 00:00:00',
      'taion' => 37.6,
      'condition' => '2,3',
      'comment' => 'やや不調',
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-12-08 00:00:00',
      'taion' => 37.7,
      'condition' => '4',
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-12-09 00:00:00',
      'taion' => 36.9,
      'condition' => '5',
      'created_at' => '2020-12-06 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-01-08 00:00:00',
      'taion' => 37.7,
      'condition' => '1,3',
      'created_at' => '2020-12-05 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-01-09 00:00:00',
      'taion' => 36.9,
      'condition' => '1',
      'created_at' => '2020-12-06 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-01-10 00:00:00',
      'taion' => 36.3,
      'condition' => '1',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-11-09 00:00:00',
      'taion' => 36.9,
      'condition' => '1',
      'created_at' => '2020-12-06 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-11-13 00:00:00',
      'taion' => 36.3,
      'condition' => '1',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-11-15 00:00:00',
      'taion' => 36.3,
      'condition' => '1',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2020-11-14 00:00:00',
      'taion' => 36.3,
      'condition' => '1',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-02-01 00:00:00',
      'taion' => 36.3,
      'comment' => '特になし',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-02-02 00:00:00',
      'taion' => 37.7,
      'condition' => '4',
      'comment' => 'やや体調不良',
      'created_at' => '2020-12-07 00:00:00',
    ]);
    DB::table('conditions')->insert([
      'user_id' => 1,
      'date' => '2021-02-10 00:00:00',
      'taion' => 36.9,
      'condition' => '5',
      'comment' => '特になし',
      'created_at' => '2020-12-07 00:00:00',
    ]);
  }
}
