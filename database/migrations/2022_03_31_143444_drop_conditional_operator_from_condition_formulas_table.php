<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropConditionalOperatorFromConditionFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condition_formulas', function (Blueprint $table) {
            $table->dropColumn('conditional_operator');
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
            $table->string('conditional_operator')->nullable();
        });
    }
}
