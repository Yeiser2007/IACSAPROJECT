<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
       
        $user = User::factory()->create([
            'name' => 'Victor Daniel Archundia Sanchez',
            'email' => 'varchundia.yei10@gmail.com',
            'password' => bcrypt('Yeiglo20'),
        ]);
        $user->assignRole('Admin');
        User::factory(20)->create();


        DB::table('employees')->insert([
            ['id' => 2, 'noi' => '91', 'employee_number' => '1', 'name' => 'EMILIO', 'last_name' => 'MORALES', 'first_name' => 'CISNEROS', 'category' => 'CHOFER', 'daily_salary' => 416.67, 'status' => 'Alta', 'hire_date' => '2023-01-13', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'CIME790602BW2', 'curp' => 'CIME790602HNLSRM01', 'imms_number' => '43977956754', 'seniority_days' => '1.89', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-05 23:04:09', 'updated_at' => '2024-12-05 23:04:09'],
            ['id' => 3, 'noi' => '100', 'employee_number' => '2', 'name' => 'moises', 'last_name' => 'rangel', 'first_name' => 'ramirez', 'category' => 'oficial', 'daily_salary' => 520.00, 'status' => 'Alta', 'hire_date' => '2023-02-01', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'RARM6505172R1', 'curp' => 'RARM650517HZSMNS00', 'imms_number' => '43846555076', 'seniority_days' => '1.84', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 05:52:48', 'updated_at' => '2024-12-06 05:52:48'],
            ['id' => 4, 'noi' => '102', 'employee_number' => '3', 'name' => 'juan francisco', 'last_name' => 'esparza', 'first_name' => 'casas', 'category' => 'oficial', 'daily_salary' => 520.00, 'status' => 'Alta', 'hire_date' => '2023-02-08', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'CAEJ710210112', 'curp' => 'CAEJ710210HCLSSN06', 'imms_number' => '47917120389', 'seniority_days' => '1.82', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:00:42', 'updated_at' => '2024-12-06 06:00:42'],
            ['id' => 5, 'noi' => '131', 'employee_number' => '4', 'name' => 'jose gabriel', 'last_name' => 'lopez', 'first_name' => 'rodriguez', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2023-08-25', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'ROLG050420F46', 'curp' => 'ROLG050420HCLDPBA8', 'imms_number' => '24160557625', 'seniority_days' => '1.28', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:09:47', 'updated_at' => '2024-12-06 06:09:47'],
            ['id' => 6, 'noi' => '132', 'employee_number' => '5', 'name' => 'antonio de jesus', 'last_name' => 'estrada', 'first_name' => 'cortez', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2023-08-30', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'COEA910328182', 'curp' => 'COEA910328HCLRSN00', 'imms_number' => '43089140628', 'seniority_days' => '1.27', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:18:57', 'updated_at' => '2024-12-06 06:18:57'],
            ['id' => 7, 'noi' => '142', 'employee_number' => '6', 'name' => 'jahir ismael', 'last_name' => 'cisneros', 'first_name' => 'ortíz', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2023-09-13', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'OICJ9710207V9', 'curp' => 'OICJ971020HNLRSR05', 'imms_number' => '43139754873', 'seniority_days' => '1.23', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:27:21', 'updated_at' => '2024-12-06 06:27:21'],
            ['id' => 8, 'noi' => '167', 'employee_number' => '7', 'name' => 'sergio', 'last_name' => 'estrada', 'first_name' => 'estrada', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2024-03-27', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'EAES760526BDA', 'curp' => 'EAES760526HNLSSR06', 'imms_number' => '60917675351', 'seniority_days' => '0.69', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:36:21', 'updated_at' => '2024-12-06 06:36:21'],
            ['id' => 9, 'noi' => '176', 'employee_number' => '8', 'name' => 'luis antonio', 'last_name' => 'hernandez', 'first_name' => 'hurtado', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2024-06-25', 'termination_date' => NULL, 'gender' => 'M', 'payroll_type' => 'A', 'rfc' => 'HUHL040705QJ7', 'curp' => 'HUHL040705HTSRRSA7', 'imms_number' => '35220430231', 'seniority_days' => '0.44', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:46:28', 'updated_at' => '2024-12-06 06:46:28'],
            ['id' => 10, 'noi' => '184', 'employee_number' => '9', 'name' => 'GABRIELA', 'last_name' => 'DOMINGUEZ', 'first_name' => 'PEREZ', 'category' => 'ayudante general', 'daily_salary' => 252.75, 'status' => 'Alta', 'hire_date' => '2024-07-02', 'termination_date' => NULL, 'gender' => 'F', 'payroll_type' => 'A', 'rfc' => 'PEDG011003N75', 'curp' => 'PEDG011003MHGRMBA2', 'imms_number' => '05210101852', 'seniority_days' => '0.42', 'img_url' => '', 'employee_type' => 'INTERNO', 'payment_type' => 'SEMANAL', 'created_at' => '2024-12-06 06:55:00', 'updated_at' => '2024-12-06 06:55:00'],
        ]);
        $this->call(FillVacations::class);
    }
}
