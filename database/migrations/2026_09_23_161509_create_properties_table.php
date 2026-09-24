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

            // User who submitted the property
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // How the user submitted this particular property
            $table->enum('submitted_as', [
                'owner',
                'agent',
                'builder',
                'other',
            ]);

            // Basic property information
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable();

            // Buy / Rent
            $table->enum('purpose', [
                'sale',
                'rent',
            ]);

            // Property category
            $table->foreignId('property_type_id')
                ->constrained('property_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Pricing
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('security_deposit', 15, 2)->nullable();
            $table->decimal('maintenance_charge', 15, 2)->nullable();

            // Property specifications
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();

            $table->decimal('built_up_area', 12, 2)->nullable();
            $table->decimal('carpet_area', 12, 2)->nullable();

            $table->unsignedSmallInteger('floor')->nullable();
            $table->unsignedSmallInteger('total_floors')->nullable();

            $table->string('furnishing', 50)->nullable();

            $table->unsignedSmallInteger('property_age')->nullable();

            $table->boolean('parking')->default(false);
            $table->boolean('balcony')->default(false);

            // Living preferences / requirements
            $table->enum('family_type', [
                'family',
                'bachelor',
                'any',
            ])->nullable();

            $table->unsignedTinyInteger('maximum_persons')->nullable();

            // Utilities
            $table->boolean('water_available')->default(false);
            $table->boolean('electricity_available')->default(false);

            // Location
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('locality', 150)->nullable();
            $table->text('address')->nullable();
            $table->string('pincode', 10)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Workflow
            $table->enum('status', [
                'draft',
                'submitted',
                'under_review',
                'approved',
                'published',
                'rejected',
                'booked',
                'closed',
                'expired',
                'removed',
            ])->default('draft');

            $table->text('rejection_reason')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamp('booked_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            $table->timestamps();

            // Indexes for public filtering/admin queries
            $table->index(['status', 'purpose']);
            $table->index(['property_type_id', 'status']);
            $table->index(['city', 'status']);
            $table->index(['state', 'city']);
            $table->index(['price', 'status']);
            $table->index(['bedrooms', 'status']);
            $table->index(['family_type', 'status']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
