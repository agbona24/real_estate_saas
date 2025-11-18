<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('agencies')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('agency_branches')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['land', 'house', 'apartment', 'shortlet', 'commercial', 'estate'])->default('house');
            $table->enum('listing_type', ['sale', 'rent', 'lease'])->default('sale');
            $table->decimal('price', 15, 2);
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('size', 10, 2)->nullable();
            $table->string('size_unit')->default('sqm');
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('Nigeria');
            $table->string('zip_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['available', 'sold', 'rented', 'pending', 'off-market'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->json('features')->nullable();
            $table->json('metadata')->nullable();
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'status']);
            $table->index(['type', 'listing_type']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
