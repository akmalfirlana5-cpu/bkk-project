<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Imports\UsersImport;
use App\Exports\UsersTemplateExport;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Daftar Pengguna';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah User Baru'),
            
            Action::make('import')
                ->label('Import Pengguna Baru')
                ->color('success')
                ->form([
                    Action::make('downloadTemplate')
                        ->label('Download Template')
                        ->color('info')
                        ->action(function () {
                        return Excel::download(new UsersTemplateExport, 'template_import_user.xlsx');
                    }),
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                            'text/csv'
                        ])
                        ->storeFiles(false)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $file = $data['file'];
                    
                    Excel::import(new UsersImport, $file);
                    
                    Notification::make()
                        ->title('Import Berhasil!')
                        ->body('Data user dari Excel berhasil diimport.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
