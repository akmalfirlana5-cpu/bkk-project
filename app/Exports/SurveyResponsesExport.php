<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class SurveyResponsesExport implements WithMultipleSheets
{
    use Exportable;

    protected Collection $responses;

    public function __construct(Collection $responses)
    {
        $this->responses = $responses->load(['category', 'answers.question']);
    }

    public function sheets(): array
    {
        $sheets = [];
        
        // Group responses by category
        $grouped = $this->responses->groupBy('category_id');

        foreach ($grouped as $categoryId => $responses) {
            $categoryName = $responses->first()->category->name ?? 'Kategori ' . $categoryId;
            
            // Limit title length (Excel max 31 chars)
            $sheetTitle = substr($categoryName, 0, 31);
            
            $sheets[] = new SurveyCategorySheetExport($sheetTitle, $responses);
        }

        return $sheets;
    }
}

