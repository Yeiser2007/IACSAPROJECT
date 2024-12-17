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
        Schema::create('weekly_incidences', function (Blueprint $table) {
            $table->id();
            $table->integer('week');
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('vacation_id')->constrained('vacations');
            $table->string('double_hours');
            $table->string('triple_hours');
            $table->string('sunday_premium');
            $table->string('vacation_bonus');
            $table->integer('days_worked');
            $table->float('loan_charge_initial');
            $table->float('loan_partial');
            $table->float('loan_lapse');
            $table->float('balance');
            $table->float('fair_bonus_vacation');
            $table->float('punctuality_bonus');
            $table->string('turn');
            $table->date('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_incidences');
    }
};
