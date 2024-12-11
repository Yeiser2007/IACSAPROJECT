<?php

namespace App\Exports;

use App\Models\Incidences;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class IncidencesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    protected $data;
    protected $week;
    public $dayStart;
    public $dayEnd;
    public $month;
    public $year;

    public function __construct($data, $week, $month, $year, $startWeek, $endWeek)
    {
        $this->data = $data;
        $this->week = $week;
        $this->month = $month;
        $this->year = $year;
        $this->dayStart = $startWeek;
        $this->dayEnd = $endWeek;
    }

    public function collection()
    {
        $exportData = [];
        $exportData[] = [
            '', '', '', '', '', '', '', '', '', '', '', '' // Fila vacía en A4
        ];

        // Ahora llena el resto de los datos
        foreach ($this->data as $employeeIncidences) {
            $totalHours = $employeeIncidences['totalHours'];
            $holiday = $employeeIncidences['holiday'];
            $sundayPremium = $employeeIncidences['sundayPremium'];

            foreach ($employeeIncidences['incidences'] as $dayName => $dayIncidences) {
                $row = [
                    'Empleado' => $employeeIncidences['employees']['name'],
                    'Fecha' => ucfirst($dayName),
                    'Horario' => $dayIncidences->map(function ($incidence) {
                        return "{$incidence->entry_time} - {$incidence->exit_time}";
                    })->implode(', '),
                    'Horario Trabajado' => $dayIncidences->map(function ($incidence) {
                        if ($incidence->recorded_schedule == "Falta") {
                            return "Falta";
                        }
                        return "{$incidence->entry_time} - {$incidence->recorded_schedule}";
                    })->implode(', '),
                    'Horario Extra' => $dayIncidences->map(function ($incidence) {
                        if ($incidence->recorded_schedule == "Falta" || $incidence->exit_time == $incidence->recorded_schedule) {
                            return "";
                        }
                        return "{$incidence->recorded_schedule} - {$incidence->exit_time}";
                    })->implode(', '),
                    'Motivo de Tiempo extra' => $dayIncidences->map(function ($incidence) {
                        return $incidence->reason;
                    })->implode(', '),
                    'Horas Extra' => $dayIncidences->map(function ($incidence) {
                        return $incidence->overtime_hours;
                    })->implode(', '),
                    'Total TE' => $totalHours,
                    'Descanso o Festivo laborado' => $holiday,
                    'Prima Dominical' => $sundayPremium,
                    'Habilitacion' => $dayIncidences->map(function ($incidence) {
                        return $incidence->abilitation_id;
                    })->implode(', '),
                    'Comentarios' => $dayIncidences->map(function ($incidence) {
                        return $incidence->comments;
                    })->implode(', ')
                ];

                $exportData[] = $row;
            }
        }

        return collect($exportData);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Fecha',
            '',
            '',
            '',
            '',
            '',
            '',
            'Descanso o Festivo laborado',
            'Prima dominical',
            'Habilitacion',
            'Comentarios'
        ];
    }
    public function startCell(): string
    {
        return 'A3';
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 5;
                $currentRowStart = $startRow;

                $sheet->setCellValue('C4', 'Horario');
                $sheet->setCellValue('D4', 'Horario Trabajado');
                $sheet->setCellValue('E4', 'Horario Extra');
                $sheet->setCellValue('F4', 'Motivo de Tiempo extra');
                $sheet->setCellValue('G4', 'Horas Extra');
                $sheet->setCellValue('H4', 'total TE');

                $sheet->mergeCells('A1:L1');
                $sheet->setCellValue('A1', 'REPORTE DE INCIDENCIAS DE OPERACIONES');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3E5C9A'], // Cambia este color si lo necesitas
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->mergeCells('A2:L2');
                $sheet->setCellValue('A2', 'Semana ' . $this->week . ' Del ' . $this->dayStart . ' al ' . $this->dayEnd . ' de ' . $this->month . ' del ' . $this->year);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3E5C9A'], // Cambia este color si lo necesitas
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->mergeCells('C3:H3');
                $sheet->setCellValue('C3', 'Horario trabajado'); // Cambia el texto según sea necesario
                $sheet->getStyle('A3:L3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3E5C9A'], // Cambia este color si lo necesitas
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],

                ]);


                $sheet->getStyle('A4:L4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '3E5C9A'], // Ajusta este color a tus necesidades
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                // Estilos generales de celdas
                $sheet->getStyle('A1:L1' . ($sheet->getHighestRow()))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);


                $sheet->mergeCells("A3:A4");
                $sheet->mergeCells("B3:B4");
                $sheet->mergeCells("I3:I4");
                $sheet->mergeCells("J3:J4");
                $sheet->mergeCells("K3:K4");
                $sheet->mergeCells("L3:L4");

                foreach ($this->data as $employeeIncidences) {
                    $rowCount = count($employeeIncidences['incidences']);
                    $sheet->mergeCells("A{$currentRowStart}:A" . ($currentRowStart + $rowCount - 1));
                    $sheet->mergeCells("H{$currentRowStart}:H" . ($currentRowStart + $rowCount - 1));
                    $sheet->mergeCells("I{$currentRowStart}:I" . ($currentRowStart + $rowCount - 1));
                    $sheet->mergeCells("J{$currentRowStart}:J" . ($currentRowStart + $rowCount - 1));

                    $sheet->getStyle("A{$currentRowStart}:L" . ($currentRowStart + $rowCount - 1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                    $currentRowStart += $rowCount;
                }
                $totalRows = $currentRowStart;  
                $columnsToColor = ['C', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
                foreach ($columnsToColor as $column) {
                    $sheet->getStyle("{$column}{$startRow}:{$column}{$totalRows}")->applyFromArray([
                        'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF2CC'], // Cambia este color si lo necesitas
                    ],
                    ]);
                }
                $sheet->getStyle("D{$startRow}:D{$totalRows}")->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'DDEBF7'], // Cambia este color si lo necesitas
                    ],
                ]);
            },
        ];
    }
}