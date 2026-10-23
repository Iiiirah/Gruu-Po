<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_status_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id');
            $table->unsignedInteger('changed_by');
            $table->string('old_status');
            $table->string('new_status');
            $table->text('remarks');
            $table->timestamp('changed_at')->useCurrent();

            $table->foreign('request_id')
                ->references('id')
                ->on('document_request')
                ->restrictOnDelete();

            $table->foreign('changed_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table->index(['request_id', 'changed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_status_history');
    }
};
