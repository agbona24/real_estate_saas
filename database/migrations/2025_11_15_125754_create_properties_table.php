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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->foreignId('category_id')->constrained('property_categories')->onDelete('cascade');
            $table->enum('type', ['sale', 'rent', 'lease', 'shortlet'])->default('sale');
            $table->enum('status', ['available', 'sold', 'rented', 'pending', 'draft'])->default('draft');
            $table->decimal('price', 15, 2);
            $table->string('price_period')->nullable(); // per month, per year, per night
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // in sqft or sqm
            $table->string('area_unit')->default('sqft');
            $table->integer('year_built')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->integer('view_count')->default(0);
            $table->json('amenities')->nullable(); // Pool, Gym, Parking, etc.
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'status']);
            $table->index(['tenant_id', 'category_id']);
            $table->index('is_published');
            $table->index('created_at');
            $table->unique(['tenant_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
