<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContacts extends ViewRecord
{
    protected static string $resource = ContactsResource::class;

    protected static string $pruralModelLabel = 'daftar masukan';

    protected static ?string $navigationLabel = 'Masukan';

    protected static ?string $modelLabel = 'Masukan';

    public function getTitle(): string
    {
        return 'Lihat Masukan';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    
}
