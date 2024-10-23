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
            $table->string('displayname', 30)->nullable();
            $table->char('username', 20);
            $table->string('bio', 250)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->default('Member'); // 1 - Admin, 2 - Moderator, 3 - Member
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('profile_image')->nullable();
            $table->string('profile_banner')->nullable();
            $table->integer('social_email')->default(0);
            $table->string('social_website')->nullable();
            $table->string('social_x', 15)->nullable(); // 5 - 15
            $table->string('social_facebook', 50)->nullable(); // 5 - 50
            $table->string('social_instagram', 30)->nullable(); 
            $table->string('social_youtube', 30)->nullable(); // 3 - 30
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
