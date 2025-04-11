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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique();
            $table->string('position');
            $table->string('office_colleges');
            $table->string('employment_classification');
            $table->string('status');
            $table->string('sex');
            $table->string('image')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('philhealth_id')->nullable();
            $table->string('pag_ibig_id')->nullable();
            $table->string('tin_id')->nullable();
            $table->string('gsis_id')->nullable();
            $table->string('phone_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
