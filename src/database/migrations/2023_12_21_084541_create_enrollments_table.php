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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('school_year_id')->nullable()->constrained();
            $table->foreignId('class_id')->nullable()->constrained();
            $table->enum('status', ['Pending', 'Assessment', 'Approved'])->default('Pending');
            $table->date('date')->nullable();
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->timestamps();

            $table->index('student_id');
            $table->index('class_id');
            $table->index('school_year_id');
            $table->index('date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
