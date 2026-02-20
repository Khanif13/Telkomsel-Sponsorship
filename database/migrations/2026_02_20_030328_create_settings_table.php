<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, image, toggle
            $table->timestamps();
        });

        // Seed Initial Landing Page Data
        $defaults = [
            'hero_title' => 'Empowering Brilliant Ideas.',
            'hero_subtitle' => 'Seamlessly submit, track, and manage sponsorship proposals.',
            'about_section' => 'Telkomsel SponsorHub is an official enterprise portal.',
            'vision' => 'To be the leading digital ecosystem enabler.',
            'mission' => 'Empowering Indonesian society through digital innovation.',
            'section_features_enabled' => '1',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('settings')->insert(['key' => $key, 'value' => $value]);
        }
    }
};
