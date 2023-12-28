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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gender_id')->constrained();
            $table->string('image',100)->nullable();
            $table->string('email',100)->unique();
            $table->string('first_name',100);
            $table->string('middle_name',100)->nullable();
            $table->string('last_name',100);
            $table->date('date_of_birth');
            $table->string('phone_number_1',15);
            $table->string('phone_number_2',15)->nullable();
            $table->string('emergency_contact_1',15);
            $table->string('emergency_contact_2',15)->nullable();
            $table->boolean('active')->default(true);
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->timestamps();

            $table->index('gender_id');
            $table->index('email');
            $table->index('first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
