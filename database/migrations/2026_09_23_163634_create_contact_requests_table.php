<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('name', 255);

            $table->string('phone', 20);

            $table->string('email', 255)->nullable();

            $table->enum('requester_type', [
                'buyer',
                'tenant',
                'owner',
                'agent',
                'builder',
                'other',
            ]);

            $table->enum('purpose', [
                'buy',
                'rent',
            ])->nullable();

            $table->foreignId('property_type_id')
                ->nullable()
                ->constrained('property_types')
                ->nullOnDelete();

            $table->unsignedTinyInteger('bedrooms')->nullable();

            $table->string('preferred_location', 255)->nullable();

            $table->decimal('budget_min', 15, 2)->nullable();

            $table->decimal('budget_max', 15, 2)->nullable();

            $table->unsignedTinyInteger('number_of_people')->nullable();

            $table->enum('family_type', [
                'family',
                'bachelor',
                'any',
            ])->nullable();

            $table->unsignedSmallInteger('preferred_floor')->nullable();

            $table->boolean('water_required')->nullable();

            $table->boolean('electricity_required')->nullable();

            $table->text('additional_requirements')->nullable();

            $table->text('message')->nullable();

            $table->enum('status', [
                'new',
                'contacted',
                'in_progress',
                'closed',
                'cancelled',
            ])->default('new');

            $table->timestamps();

            $table->index(['requester_type', 'status']);
            $table->index(['purpose', 'status']);
            $table->index(['preferred_location', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
