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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable();
            $table->string('address',100)->nullable();
            $table->string('land_mark',10)->nullable();
            $table->string('contact_person',100)->nullable();
            $table->string('phone_number',100)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('student_id');
            $table->index('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
