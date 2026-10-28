<?php

namespace App\Filament\Resources\DocumentLibraryResource\Pages;

use App\Filament\Resources\DocumentLibraryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentLibraries extends ListRecords
{
    protected static string $resource = DocumentLibraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
