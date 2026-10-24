<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id');
            $table->unsignedInteger('requirement_id');
            $table->string('file_path');
            $table->string('original_filename');
            $table->timestamp('uploaded_at')->useCurrent();

            $table->foreign('request_id')
                ->references('id')
                ->on('document_request')
                ->restrictOnDelete();

            $table->foreign('requirement_id')
                ->references('id')
                ->on('document_requirements')
                ->restrictOnDelete();

            $table->index(['request_id', 'uploaded_at']);
            $table->index('requirement_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_attachments');
    }
};
