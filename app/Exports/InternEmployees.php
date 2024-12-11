<?php

namespace App\Exports;

use App\Models\EmployeeInternal;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InternEmployees implements FromCollection, WithHeadings, WithStyles, WithTitle, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('employees')
            ->join('internal_employees', 'employees.id', '=', 'internal_employees.employee_id')
            ->select(
                'employees.noi',
                'employees.employee_number',
                'employees.name',
                'employees.first_name',
                'employees.last_name',
                'employees.category',
                'employees.daily_salary',
                'internal_employees.integrated_daily_salary',
                'employees.status',
                'employees.hire_date',
                'employees.termination_date',
                'employees.gender',
                'internal_employees.age',
                'employees.payroll_type',
                'internal_employees.full_address',
                'internal_employees.postal_code',
                'employees.rfc',
                'employees.curp',
                'employees.imms_number',
                'internal_employees.descount_infonavit',
                'internal_employees.descount_FONACOT',
                'employees.seniority_days',
                'internal_employees.residence',
                'internal_employees.state',
                'internal_employees.level_study',
                'internal_employees.job',
                'internal_employees.license_vehicle',
                'internal_employees.phone',
                'internal_employees.familiar_phone'
            )
            ->orderBy('employees.employee_number')
            ->orderBy('employees.first_name', 'ASC')
            ->get();


    }


    public function title(): string
    {
        return 'EMPLEADOS INTERNOS';
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
            'SALARIO DIARIO',
            'SALARIO DIARIO INTEGRADO',
            'ESTATUS',
            'FECHA INGRESO',
            'FECHA BAJA',
            'GENERO',
            'EDAD',
            'TIPO DE NOMINA',
            'DIRECCIÓN COMPLETA',
            'CODIGO POSTAL',
            'RFC',
            'CURP',
            'NO. IMSS',
            'DESCUENTO INFONAVIT',
            'DESCUENTO FONACOT',
            'ANTIGUEDAD',
            'RESIDENCIA',
            'ESTADO',
            'NIVEL ESCOLAR',
            'OFICIO',
            'LICENCIA DE VEHÍCULO',
            'TELÉFONO DE CONTACTO',
            'TELÉFONO FAMILIAR',
        ];

    }
    public function startCell(): string
    {
        return 'B4';
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B4:AD4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4472C4']
            ]
        ]);

        $range = 'B4:AD4' . $sheet->getHighestRow();  


        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 
                    'color' => ['argb' => '000000'],
                ]
            ]
        ]);

        foreach (range('B', 'Z') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }

}
