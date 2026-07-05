<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date_of_birth')->nullable();

            $table->enum('gender',[
                'Male',
                'Female',
                'Other'
            ])->nullable();

            $table->string('nationality')->default('Bangladeshi');

            $table->text('current_address')->nullable();

            $table->text('permanent_address')->nullable();

            $table->string('linkedin')->nullable();

            $table->string('github')->nullable();

            $table->string('portfolio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};