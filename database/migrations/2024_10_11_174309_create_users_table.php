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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // School-specific fields
            $table->string('school_registration_number')->nullable();
            $table->string('school_address_location')->nullable();
            $table->string('school_facebook_link')->nullable();
            $table->string('school_instagram_link')->nullable();
            $table->string('school_twitter_link')->nullable();
            $table->string('school_website_link')->nullable();
            $table->string('school_logo')->nullable();
            $table->string('school_motto')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('teachers_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for the user (school)
            $table->string('teacher_name');
            $table->string('teacher_email')->unique();
            $table->string('teacher_password');
            $table->string('teacher_role');
            $table->string('teacher_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_information');
        Schema::dropIfExists('users');
    }
};
