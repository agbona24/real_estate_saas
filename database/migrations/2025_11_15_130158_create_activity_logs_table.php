<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->nullable()->constrained('agencies')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // created, updated, deleted, viewed
            $table->string('model'); // Property, Lead, Client, etc.
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('description');
            $table->json('changes')->nullable(); // Before and after values
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->index(['tenant_id', 'user_id']);
            $table->index('created_at');
        });
    }
    public function down(): void { Schema::dropIfExists('activity_logs'); }
};
