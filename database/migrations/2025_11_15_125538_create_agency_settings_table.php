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
        Schema::create('agency_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
            $table->string('timezone')->default('UTC');
            $table->string('currency')->default('USD');
            $table->string('date_format')->default('Y-m-d');
            $table->string('time_format')->default('H:i');
            $table->string('theme')->default('default');
            $table->json('theme_settings')->nullable(); // colors, fonts, etc.
            $table->string('primary_color')->default('#3B82F6');
            $table->string('secondary_color')->default('#10B981');
            $table->json('email_settings')->nullable();
            $table->json('sms_settings')->nullable();
            $table->boolean('allow_client_registration')->default(true);
            $table->boolean('require_email_verification')->default(true);
            $table->timestamps();

            $table->unique('tenant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_settings');
    }
};
