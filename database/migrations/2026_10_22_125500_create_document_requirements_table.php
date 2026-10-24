<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_type');
            $table->string('requirement_name');
            $table->text('description');
            $table->boolean('is_required');

            $table->foreign('document_type')
                ->references('id')
                ->on('documment_type')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_requirements');
    }
};
