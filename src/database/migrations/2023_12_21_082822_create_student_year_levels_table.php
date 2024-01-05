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
        Schema::create('student_year_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('school_year_id')->constrained();
            $table->foreignId('level_id')->constrained();
            $table->boolean('active')->default(true);
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->timestamps();

            $table->index('student_id');
            $table->index('school_year_id');
            $table->index('level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_year_levels');
    }
};
