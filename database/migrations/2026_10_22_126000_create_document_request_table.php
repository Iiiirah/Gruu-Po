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
        Schema::create('document_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->unique();
            $table->unsignedInteger('resident_id');
            $table->unsignedInteger('document_type');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->unsignedInteger('decided_by')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'released'])
                ->default('pending');
            $table->text('purpose');
            $table->text('description_remarks');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('decided_at')->nullable();

            $table->foreign('resident_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table->foreign('document_type')
                ->references('id')
                ->on('documment_type')
                ->restrictOnDelete();

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('decided_by')
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
        Schema::dropIfExists('document_request');
    }
};
