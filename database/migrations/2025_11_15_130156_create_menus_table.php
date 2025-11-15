<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
            $table->string('name');
            $table->string('location'); // header, footer, sidebar
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['tenant_id', 'location']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
