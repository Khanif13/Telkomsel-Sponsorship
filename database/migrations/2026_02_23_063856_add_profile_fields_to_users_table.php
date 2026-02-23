<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('organizer_name')->nullable()->after('name');
            $table->string('position')->nullable()->after('organizer_name');
            $table->string('contact_email')->nullable()->after('position');
            $table->text('address')->nullable()->after('contact_email');
            $table->string('organizer_category')->nullable()->after('address');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['organizer_name', 'position', 'contact_email', 'address', 'organizer_category']);
        });
    }
};
