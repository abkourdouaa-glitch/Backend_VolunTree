<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('benevoles', function (Blueprint $table) {
            // we use string to store the image path (e.g., 'uploads/profiles/pic.jpg')
            $table->string('photo_profile')->nullable()->after('email'); 
        });
    }

    public function down(): void
    {
        Schema::table('benevoles', function (Blueprint $table) {
            $table->dropColumn('photo_profile');
        });
    }
};