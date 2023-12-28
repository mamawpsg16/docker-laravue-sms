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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable()->constrained();
            $table->foreignId('classroom_id')->nullable()->constrained();
            $table->string('name',100)->unique();
            $table->boolean('active')->default(true);
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->timestamps();

            $table->index('name');
            $table->index('teacher_id');
            $table->index('classroom_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
