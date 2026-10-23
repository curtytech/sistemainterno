<?php

namespace App\Filament\Resources\MeetingCategoryResource\Pages;

use App\Filament\Resources\MeetingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeetingCategories extends ListRecords
{
    protected static string $resource = MeetingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
