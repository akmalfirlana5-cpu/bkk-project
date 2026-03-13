<?php

namespace App\Exports;

use App\Models\SurveyQuestion;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SurveyResponsesExport implements FromArray, WithHeadings, WithStyles
{
    use Exportable;

    protected Collection $responses;
    protected array $questions = [];
    protected array $identityKeys = [];

    public function __construct(Collection $responses)
    {
        $this->responses = $responses->load(['category', 'answers.question']);

        // Get the category from first response
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

            // Get all active questions for this category
            $this->questions = SurveyQuestion::where('category_id', $firstResponse->category_id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->toArray();
        }
    }

    public function headings(): array
    {
        $headers = ['No', 'No HP', 'Tanggal'];

        // Identity field headers
        foreach ($this->identityKeys as $field) {
            $headers[] = $field['label'];
        }

        // Question headers
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

            // Identity data
            $identityData = $response->identity_data ?? [];
            foreach ($this->identityKeys as $field) {
                $row[] = $identityData[$field['key']] ?? '-';
            }

            // Answers — indexed by question_id for quick lookup
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
