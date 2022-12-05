<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->foreignId('target_year_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('parameter_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pic');
            $table->float('target');
            $table->float('bobot');
            $table->enum('status', [0,1,2,3])->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
}
