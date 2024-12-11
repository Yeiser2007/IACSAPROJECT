<?php

namespace App\Exports;

use App\Models\EmployeeExternal;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExternalEmployees implements FromCollection, WithTitle, WithHeadings, WithStyles, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('employees')
            ->join('external_employees', 'employees.id', '=', 'external_employees.employee_id')
            ->select(
                'employees.noi',
                'employees.employee_number',
                'employees.name',
                'employees.first_name',
                'employees.last_name',
                'employees.category',
                'employees.status',
                'employees.hire_date',
                'employees.gender',
                'employees.rfc',
                'employees.curp',
                'external_employees.work_code',
                'employees.payroll_type',
                'employees.imms_number',
                'employees.termination_date',
                'employees.seniority_days',
                'employees.daily_salary'
            )
            ->orderBy('employees.employee_number')
            ->orderBy('employees.first_name', 'ASC')
            ->get();


    }

    public function title(): string
    {
        return 'EMPLEADOS EXTERNOS';
    }
    public function headings(): array
    {
        return [
            'NOI',
            'NO. EMPLEADO',
            'NOMBRE',
            'PRIMER APELLIDO',
            'SEGUNDO APELLIDO',
            'CATEGORIA',
            'ESTATUS',
            'FECHA INGRESO',
            'GENERO',
            'RFC',
            'CURP',
            'CODIGO DE OBRA',
            'TIPO DE NOMINA',
            'NO. IMSS',
            'FECHA BAJA',
            'ANTIGUEDAD',
            'SALARIO DIARIO',
        ];
    }
    public function startCell(): string
    {
        return 'B4';
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B4:R4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4472C4']
            ]
        ]);
        $range = 'B4:R4' . $sheet->getHighestRow();  

        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 
                    'color' => ['argb' => '000000'], 
                ]
            ]
        ]);

        foreach (range('B', 'R') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
