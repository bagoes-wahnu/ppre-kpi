<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterConditionFormulasChangeEndValueToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condition_formulas', function (Blueprint $table) {
            $table->float('end_value')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condition_formulas', function (Blueprint $table) {
            $table->float('end_value')->nullable(false)->change();
        });
    }
}
