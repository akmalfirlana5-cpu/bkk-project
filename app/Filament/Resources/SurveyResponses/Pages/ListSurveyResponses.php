<?php

namespace App\Filament\Resources\SurveyResponses\Pages;

use App\Filament\Resources\SurveyResponses\SurveyResponseResource;
use App\Models\SurveyCategory;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Tabs\Tab;

class ListSurveyResponses extends ListRecords
{
    protected static string $resource = SurveyResponseResource::class;
    protected static ?string $title = 'Hasil Survey';

    public function getTabs(): array
    {
        $tabs = [
            'semua' => Tab::make('Semua')
                ->icon('heroicon-o-squares-2x2'),
        ];

        $categories = SurveyCategory::orderBy('id')->get();

        foreach ($categories as $category) {
            $tabs[$category->slug] = Tab::make($category->name)
                ->modifyQueryUsing(fn ($query) => $query->where('category_id', $category->id))
                ->badge(fn () => $category->responses()->count());
        }

        return $tabs;
    }

    public function getTabsContentComponent(): Component
    {
        return parent::getTabsContentComponent()->contained(true);
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString(
            parent::getHeading() .
            '<style>
                .fi-sc-tabs { border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; border-bottom: 0 !important; margin-bottom: -1.5rem !important; position: relative; z-index: 10; }
                .fi-ta-ctn { border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; border-top: 0 !important; }
            </style>'
        );
    }
}
