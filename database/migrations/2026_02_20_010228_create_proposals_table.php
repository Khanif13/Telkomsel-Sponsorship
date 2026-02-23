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
            $table->string('request_type');
            $table->text('support_description')->nullable();
            $table->json('packages')->nullable();
            $table->text('description')->nullable();
            $table->string('proposal_file');
            $table->enum('status', ['pending', 'under_review', 'need_revision', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
