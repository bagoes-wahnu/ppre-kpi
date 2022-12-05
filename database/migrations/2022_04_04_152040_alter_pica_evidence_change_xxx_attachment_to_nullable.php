<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPicaEvidenceChangeXxxAttachmentToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pica_evidence', function (Blueprint $table) {
            $table->string('initial_attachment')->nullable(true)->change();
            $table->string('correction_attachment')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pica_evidence', function (Blueprint $table) {
            $table->string('initial_attachment')->nullable(false)->change();
            $table->string('correction_attachment')->nullable(false)->change();
        });
    }
}
