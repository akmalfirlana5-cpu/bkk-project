<?php

namespace App\Exports;

use App\Models\SurveyQuestion;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SurveyCategorySheetExport implements FromArray, WithHeadings, WithStyles, WithTitle, WithColumnFormatting
{
    protected Collection $responses;
    protected string $title;
    protected array $questions = [];
    protected array $identityKeys = [];

    public function __construct(string $title, Collection $responses)
    {
        $this->title = $title;
        $this->responses = $responses;

        $firstResponse = $responses->first();
        if ($firstResponse && $firstResponse->category) {
            // Build identity field keys
            $identityFields = $firstResponse->category->identity_fields ?? [];
            foreach ($identityFields as $field) {
                $this->identityKeys[] = [
                    'key' => $field['key'],
                    'label' => $field['label'],
                ];
            }

            // Get all active questions for THIS category
            $this->questions = SurveyQuestion::where('category_id', $firstResponse->category_id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->toArray();
        }
    }

    public function columnFormats(): array
    {
        $formats = [
            'B' => NumberFormat::FORMAT_TEXT, // Kolom No HP Utama
        ];

        // Cari kolom NIK atau No HP di identity fields
        // Urutan kolom: A=No, B=No HP, C=Tanggal, D=Identity1, E=Identity2...
        $startColumnIndex = 4; // Dimulai dari column 'D'
        foreach ($this->identityKeys as $index => $field) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($startColumnIndex + $index);
            
            $key = strtolower($field['key']);
            if (str_contains($key, 'nik') || str_contains($key, 'hp') || str_contains($key, 'phone') || str_contains($key, 'kontak') || str_contains($key, 'wa')) {
                $formats[$columnLetter] = NumberFormat::FORMAT_TEXT;
            }
        }

        return $formats;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        $headers = ['No', 'No HP', 'Tanggal'];

        foreach ($this->identityKeys as $field) {
            $headers[] = $field['label'];
        }

        foreach ($this->questions as $q) {
            $headers[] = $q['question_text'];
        }

        return $headers;
    }

    public function array(): array
    {
        $rows = [];
        $no = 1;

        foreach ($this->responses as $response) {
            $row = [
                $no++,
                $response->phone,
                $response->created_at->format('d/m/Y'),
            ];

            $identityData = $response->identity_data ?? [];
            foreach ($this->identityKeys as $field) {
                $row[] = $identityData[$field['key']] ?? '-';
            }

            $answersMap = [];
            foreach ($response->answers as $answer) {
                $answersMap[$answer->question_id] = $answer->answer;
            }

            foreach ($this->questions as $q) {
                $row[] = $answersMap[$q['id']] ?? '-';
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
