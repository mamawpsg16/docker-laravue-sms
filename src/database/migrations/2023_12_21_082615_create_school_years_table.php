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
        Schema::create('school_years', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('active')->default(true);
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->timestamps();


            $table->index('name');
            $table->index('start_date');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_years');
    }
};
