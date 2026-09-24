<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_enquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('property_id')
                ->constrained('properties')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name', 255);

            $table->string('phone', 20);

            $table->string('email', 255)->nullable();

            $table->text('message')->nullable();

            $table->enum('status', [
                'new',
                'contacted',
                'in_progress',
                'closed',
                'cancelled',
            ])->default('new');

            $table->timestamps();

            $table->index(['property_id', 'status']);
            $table->index(['user_id', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_enquiries');
    }
};
