<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\Vacations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FillVacations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employees::all();
        foreach ($employees as $employee) {
            $vacation = new Vacations();
            $vacation->employee_id = $employee->id;
            $vacation->days = 15;
            $vacation->remaining_days = 0;
            $vacation->save();
        }
    }
}
