<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersTemplateExport implements FromArray, WithStyles, WithColumnWidths
{


    public function array(): array
    {
        $majors = implode(', ', array_keys(\App\Models\vacancie::MAJORS));
        
        return [
            // Row 1: Header (Wajib di Baris 1 agar terbaca sistem dengan baik)
            ['nisn', 'nama_lengkap', 'jurusan', 'tahun_lulus'],

            // Row 2: Contoh Data / Instruksi
            [
                "Contoh: '1234567890", // Pakai tanda kutip satu untuk angka
                'Budi Santoso', 
                'Rekayasa Perangkat Lunak', // Pastikan sesuai daftar jurusan
                '2024' // Tahun lulus format teks
            ],
            
            // Row 3: Info Tambahan (Akan diskip oleh sistem import)
            ['INFO PENTING:', 'Gunakan tanda kutip (\') sebelum NISN.', 'Jurusan Tersedia: ' . $majors, '']
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style Header (Row 1)
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'], // Indigo color
            ],
        ]);

        // Style Info Row (Row 3) - Optional, biar kebaca user
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['italic' => true, 'color' => ['rgb' => 'FF0000']],
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,  // nisn
            'B' => 30,  // nama_lengkap
            'C' => 35,  // jurusan
            'D' => 15,  // tahun_lulus
        ];
    }
}
