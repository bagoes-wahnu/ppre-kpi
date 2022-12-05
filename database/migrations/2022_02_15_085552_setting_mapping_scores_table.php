<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SettingMappingScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_mapping_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('setting_mapping_scores');
    }
}
