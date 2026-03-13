<?php

namespace App\Filament\Resources\SurveyResponses\Pages;

use App\Filament\Resources\SurveyResponses\SurveyResponseResource;
use App\Models\SurveyResponse;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ViewSurveyResponse extends Page
{
    protected static string $resource = SurveyResponseResource::class;
    protected string $view = 'filament.resources.survey-responses.pages.view-survey-response';

    public SurveyResponse $record;

    public function mount(int|string $record): void
    {
        $this->record = SurveyResponse::with(['category', 'answers.question'])->findOrFail($record);
    }

    public function getTitle(): string|Htmlable
    {
        $name = $this->record->identity_data['nama_lengkap']
            ?? $this->record->identity_data['nama_perusahaan']
            ?? 'Responden';

        return "Detail Survey: {$name}";
    }

    public function getBreadcrumbs(): array
    {
        return [
            SurveyResponseResource::getUrl() => 'Hasil Survey',
            '' => 'Detail',
        ];
    }
}
