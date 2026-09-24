<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('state', 100);

            $table->string('city', 100);

            $table->string('locality', 150)->nullable();

            $table->string('pincode', 10)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['state', 'city']);
            $table->index(['city', 'locality']);
            $table->index('pincode');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
