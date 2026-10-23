<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incident_status_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('changed_by');
            $table->string('old_status');
            $table->string('new_status');
            $table->text('remarks');
            $table->timestamp('changed_at')->useCurrent();

            $table->foreign('incident_id')
                ->references('id')
                ->on('incident_reports')
                ->restrictOnDelete();

            $table->foreign('changed_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_status_history');
    }
};
