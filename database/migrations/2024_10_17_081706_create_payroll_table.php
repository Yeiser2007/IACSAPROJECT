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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->decimal('worked_days', 8, 2);
            $table->decimal('rest_days', 8, 2);
            $table->decimal('total_overtime_hours', 8, 2);
            $table->decimal('vacation_bonus', 8, 2);
            $table->decimal('sunday_premium', 8, 2);
            $table->decimal('base_salary', 8, 2);
            $table->decimal('punctuality_bonus', 8, 2);
            $table->decimal('rest_days_worked', 8, 2);
            $table->decimal('double_overtime_hours', 8, 2);
            $table->decimal('triple_overtime_hours', 8, 2);
            $table->decimal('personal_loans', 8, 2);
            $table->decimal('special_bonus', 8, 2);
            $table->decimal('total_perceptions', 8, 2);
            $table->decimal('isr', 8, 2);
            $table->decimal('imms', 8, 2);
            $table->decimal('subtotal', 8, 2);
            $table->decimal('infonavit_discount', 8, 2);
            $table->decimal('company_loan', 8, 2);
            $table->decimal('company_discount', 8, 2);
            $table->decimal('net_pay', 8, 2);
            $table->decimal('employee_subsidy', 8, 2);
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};
