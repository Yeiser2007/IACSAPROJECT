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
        Schema::create('fortnightly_incidences', function (Blueprint $table) {
            $table->id();
            $table->integer('fortnight');
            $table->foreignId('employee_id')->constrained('employees');
            $table->float('punctuality_bonus');
            $table->float('up_imms');
            $table->float('loan');
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
        Schema::dropIfExists('fortnightly_incidences');
    }
};
