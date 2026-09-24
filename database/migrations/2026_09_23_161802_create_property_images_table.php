<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_id')
                ->constrained('properties')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('path', 500);

            $table->string('original_name', 255)->nullable();

            $table->string('mime_type', 100)->nullable();

            $table->unsignedInteger('size')->nullable();

            $table->boolean('is_primary')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['property_id', 'is_primary']);
            $table->index(['property_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
