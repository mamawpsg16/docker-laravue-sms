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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gender_id')->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('phone_number_1');
            $table->string('phone_number_2')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();

            $table->index('gender_id');
            $table->index('department_id');
            $table->index('first_name');
            $table->index('last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
