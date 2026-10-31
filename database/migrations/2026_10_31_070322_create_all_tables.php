<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();
        });

        // I-insert agad ang default roles para maiwasan ang foreign key error
        DB::table('roles')->insert([
            ['id' => 1, 'role' => 'Admin'],
            ['id' => 2, 'role' => 'Resident'],
        ]);

        // 2. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role', 50)->nullable()->default('Resident');
            $table->string('password');
            $table->string('user_account');
            $table->enum('account_status', ['pending', 'active', 'inactive', 'suspended'])->default('pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // I-insert ang Default Admin Account agad pagkatapos mabuo ang users table
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'role_id' => 1,
            'name' => 'System Admin',
            'email' => 'admin@sibul.com',
            'role' => 'Admin',
            'password' => Hash::make('admin123'),
            'user_account' => 'admin',
            'account_status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Cache Tables
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        // 4. Announcement Category & Announcements
        Schema::create('announcement_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
        });

        Schema::create('announcement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedInteger('created_by');
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('announcement_category');
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type', 50)->nullable();
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // 5. Document Types, Requirements, and Requests
        Schema::create('documment_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->decimal('fee', 10, 2);
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('document_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_type');
            $table->string('requirement_name');
            $table->text('description');
            $table->boolean('is_required');
            $table->foreign('document_type')->references('id')->on('documment_type');
        });

        Schema::create('document_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_number')->unique();
            $table->unsignedInteger('resident_id');
            $table->unsignedInteger('document_type');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->unsignedInteger('decided_by')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'released'])->default('pending');
            $table->text('purpose');
            $table->text('description_remarks');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('decided_at')->nullable();
            $table->foreign('resident_id')->references('id')->on('users');
            $table->foreign('document_type')->references('id')->on('documment_type');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('decided_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('resident_name')->nullable();
            $table->string('document_type');
            $table->text('purpose')->nullable();
            $table->string('status', 50)->default('In Progress');
            $table->timestamps();
        });

        // 6. Email Verification & Identity Documents
        Schema::create('email_verification_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('token_hash');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('identity_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('document_type');
            $table->string('files');
            $table->unsignedInteger('reviewed_by');
            $table->timestamp('reviewed_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
        });

        // 7. Events Table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('created_by');
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->timestamp('starts_at')->useCurrent();
            $table->timestamp('ends_at')->nullable();
            $table->enum('status', ['scheduled', 'cancelled', 'completed'])->default('scheduled');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
        });

        // 8. Incident Reports & Related Tables
        Schema::create('incident_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->boolean('is_active')->default(1);
        });

        Schema::create('incident_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('incident_type')->nullable();
            $table->string('zone')->nullable();
            $table->dateTime('incident_date')->nullable();
            $table->unsignedInteger('reference_number')->unique();
            $table->unsignedInteger('reported_by');
            $table->unsignedInteger('category_id');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('location');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->string('status', 50)->nullable()->default('New');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamp('resolve_at')->nullable();
            $table->timestamps();
            $table->foreign('reported_by')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('incident_categories');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('incident_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->string('file_path');
            $table->string('original_filename');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->foreign('incident_id')->references('id')->on('incident_reports');
        });

        Schema::create('incident_status_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('changed_by');
            $table->string('old_status');
            $table->string('new_status');
            $table->text('remarks');
            $table->timestamp('changed_at')->useCurrent();
            $table->foreign('incident_id')->references('id')->on('incident_reports');
            $table->foreign('changed_by')->references('id')->on('users');
        });

        // 9. Jobs & Queue Tables
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // 10. Other Supporting Tables
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('request_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id');
            $table->unsignedInteger('requirement_id');
            $table->string('file_path');
            $table->string('original_filename');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->foreign('request_id')->references('id')->on('document_request');
            $table->foreign('requirement_id')->references('id')->on('document_requirements');
        });

        Schema::create('request_status_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id');
            $table->unsignedInteger('changed_by');
            $table->string('old_status');
            $table->string('new_status');
            $table->text('remarks');
            $table->timestamp('changed_at')->useCurrent();
            $table->foreign('changed_by')->references('id')->on('users');
            $table->foreign('request_id')->references('id')->on('document_request');
        });

        Schema::create('resident_document_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('reference_no')->unique();
            $table->string('document_type');
            $table->text('purpose');
            $table->string('status')->default('In Progress');
            $table->timestamps();
        });

        Schema::create('resident_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->date('birth_date');
            $table->string('civil_status');
            $table->string('contact_number');
            $table->text('resident_address');
            $table->string('residency_status');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('resident_pure_incident_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reference_no');
            $table->string('incident_type');
            $table->string('zone');
            $table->dateTime('incident_date');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('status')->default('New');
            $table->timestamps();
        });

        Schema::create('resident_pure_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('report_id')->nullable();
            $table->string('reporter_name')->nullable();
            $table->string('zone')->default('Zone 1');
            $table->string('incident_type');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('New');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('updated_by');
            $table->string('setting_key')->unique();
            $table->text('setting_value');
            $table->timestamp('updated_at')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // I-drop sa pabaliktad na paraan para iwas foreign key constraint error
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('resident_pure_reports');
        Schema::dropIfExists('resident_pure_incident_reports');
        Schema::dropIfExists('resident_profile');
        Schema::dropIfExists('resident_document_requests');
        Schema::dropIfExists('request_status_history');
        Schema::dropIfExists('request_attachments');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('incident_status_history');
        Schema::dropIfExists('incident_attachments');
        Schema::dropIfExists('incident_reports');
        Schema::dropIfExists('incident_categories');
        Schema::dropIfExists('events');
        Schema::dropIfExists('identity_documents');
        Schema::dropIfExists('email_verification_tokens');
        Schema::dropIfExists('document_requests');
        Schema::dropIfExists('document_request');
        Schema::dropIfExists('document_requirements');
        Schema::dropIfExists('documment_type');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('announcement');
        Schema::dropIfExists('announcement_category');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('password_reset_tokens');
    }
};