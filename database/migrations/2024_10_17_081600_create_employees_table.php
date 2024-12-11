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
            $table->string('noi');
            $table->string('employee_number');
            $table->string('name');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('category');
            $table->decimal('daily_salary', 8, 2);
            $table->string('status')->nullable();
            $table->date('hire_date');
            $table->date('termination_date')->nullable();
            $table->string('gender');
            $table->string('payroll_type');
            $table->string('rfc');
            $table->string('curp');
            $table->string('imms_number');
            $table->string('seniority_days');
            $table->string('img_url')->nullable();
            $table->string('employee_type');
            $table->string('payment_type');
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
