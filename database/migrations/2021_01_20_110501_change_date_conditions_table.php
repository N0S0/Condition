<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDateConditionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('conditions', function (Blueprint $table) {
      //date→datetimeに変更
      $table->dateTime('date')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('conditions', function (Blueprint $table) {
      //
      $table->date('date')->change();
    });
  }
}
