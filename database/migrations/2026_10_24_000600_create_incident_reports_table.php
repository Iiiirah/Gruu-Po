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
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reference_number')->unique();
            $table->unsignedInteger('reported_by');
            $table->unsignedInteger('category_id');
            $table->text('description');
            $table->string('location');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamp('resolve_at')->nullable();
            $table->timestamps();

            $table->foreign('reported_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('incident_categories')
                ->restrictOnDelete();

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
