<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDbConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conditions', function (Blueprint $table) {
            //
            $table->string('condition')->after('taion');
            $table->dropColumn('taste');
            $table->dropColumn('smell');
            $table->dropColumn('cough');
            $table->dropColumn('malaise');
            $table->dropColumn('physiology');
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
            $table->dropColumn('condition');
            $table->boolean('taste')->default(false);
            $table->boolean('smell')->default(false);
            $table->boolean('cough')->default(false);
            $table->boolean('malaise')->default(false);
            $table->boolean('physiology')->default(false);
        });
    }
}
