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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_type_id')->constrained();
            $table->string('email',100)->unique();
            $table->string('first_name',100);
            $table->string('middle_name',100)->nullable();
            $table->string('last_name',100);
            $table->string('phone_number_1',15);
            $table->string('phone_number_2',15)->nullable();
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->timestamps();

            $table->index('guardian_type_id');
            $table->index('email');
            $table->index('first_name');
            $table->index('last_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
