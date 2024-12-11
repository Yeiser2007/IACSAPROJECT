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
        Schema::create('abilitations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('salary');
            $table->timestamps();
        });
        Schema::create('incidences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('record_date');
            $table->string('recorded_schedule')->nullable();
            $table->string('entry_time');
            $table->string('exit_time');
            $table->decimal('overtime_hours', 5, 2)->nullable();
            $table->decimal('sunday_premium', 8, 2)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('holiday')->nullable();
            $table->foreignId('abilitation_id')->constrained('abilitations');
            $table->string('reason')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abilitations');
        Schema::dropIfExists('incidences');
    }
};
