<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return DB::table('users')->get();
    }


    public function headings(): array
    {
        return [
            '#',
            'NOMBRE COMPLETO',
            'CORREO',
            'FECHA DE CREACION',
            'PASSWORD ENCRIPTADA',
               ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:V1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50']
            ]
        ]);
    
        // Ajustar el tamaño de cada columna
        foreach (range('A', 'V') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
    
}
