<?php

namespace App\Filament\Resources\FieldOptions\Pages;

use App\Filament\Resources\FieldOptions\FieldOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFieldOptions extends ListRecords
{
    protected static ?string $resource = FieldOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
