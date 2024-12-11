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
        Schema::create('internal_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->unique()->onDelete('cascade');
            $table->decimal('integrated_daily_salary', 8, 2);
            $table->integer('age');
            $table->text('full_address');
            $table->string('postal_code');
            $table->string('descount_infonavit');
            $table->string('descount_FONACOT');
            $table->string('level_study');
            $table->string('job');
            $table->string('license_vehicle');
            $table->string('phone');
            $table->string('familiar_phone');
            $table->string('residence');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_employees');
    }
};
