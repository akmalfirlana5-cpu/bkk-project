<?php

namespace App\Filament\Resources\SurveyResponses\Pages;

use App\Filament\Resources\SurveyResponses\SurveyResponseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSurveyResponse extends ViewRecord
{
    protected static string $resource = SurveyResponseResource::class;
    protected string $view = 'filament.resources.survey-responses.pages.view-survey-response';

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        $name = $this->record->identity_data['nama_lengkap']
            ?? $this->record->identity_data['nama_perusahaan']
            ?? 'Responden';

        return "Detail Survey: {$name}";
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString(
            parent::getHeading() .
            '<style>
                .fi-ta-ctn { border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; border-top: 0 !important; }
                .fi-section { border-radius: 0.75rem !important; }
            </style>'
        );
    }
}
