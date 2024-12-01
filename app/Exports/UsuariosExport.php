<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UsuariosExport implements FromView, WithStyles, ShouldAutoSize, WithEvents
{
    protected $usuarios;

    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function view(): View
    {
        return view('usuariospdf.excel', ['usuarios' => $this->usuarios]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            6 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '764C73'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
            'A:Z' => [
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
            7 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '925487'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
            'A:Z' => [
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }

    public function headerLogo(Worksheet $sheet)
    {
        $logoPath = public_path('images/log.png'); 

   
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo de la Empresa');
        $drawing->setPath($logoPath); 
        $drawing->setHeight(80);     
        $drawing->setCoordinates('A1'); 
        $drawing->setWorksheet($sheet);
    }

    // Método para registrar eventos
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate(); 

       
                $this->headerLogo($sheet);

           
                $sheet->setTitle('REP_USUARIOS'); 

          
                $sheet->setCellValue('A6', 'REPORTE USUARIOS');
                $sheet->mergeCells('A6:F6'); 
                $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A6')->getAlignment()->setHorizontal('center');

            
            },
        ];
    }
}
