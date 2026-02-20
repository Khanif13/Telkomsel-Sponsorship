<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 1. Event & Contact Information
            $table->string('event_name');
            $table->string('organizer');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('location');
            $table->date('event_date');
            $table->string('event_category');
            $table->string('event_scale');
            $table->integer('expected_participants');
            $table->text('target_audience');

            // 2. Sponsorship Request Logic
            $table->string('request_type');
            $table->text('support_description')->nullable();

            // 3. Dynamic Packages
            $table->json('packages')->nullable();

            // 4. Executive Summary
            $table->text('description');

            // 5. File Attachment
            $table->string('proposal_file');

            // 6. Status
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
