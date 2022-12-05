<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition_formulas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('score');
            $table->string('category');
            $table->string('description');
            $table->foreignId('kondisi_id')->constrained('kondisi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('start_value');
            $table->float('end_value');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condition_formulas');
    }
}
