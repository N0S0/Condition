<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('conditions', function (Blueprint $table) {
      //
      $table->increments('id');
      $table->unsignedInteger('user_id');
      $table->timestamps(0);
      $table->decimal('taion', 3, 1)->nullable();
      $table->integer('taste')->nullable();
      $table->integer('smell')->nullable();
      $table->integer('cough')->nullable();
      $table->integer('malaise')->nullable();
      $table->string('comment')->nullable();
      $table->integer('physiology')->nullable();

      $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
    Schema::dropIfExists('conditions');
  }
}
