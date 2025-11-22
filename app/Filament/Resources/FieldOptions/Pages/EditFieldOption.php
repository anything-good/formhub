<?php

namespace App\Filament\Resources\FieldOptions\Pages;

use App\Filament\Resources\FieldOptions\FieldOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFieldOption extends EditRecord
{
    protected static ?string $resource = FieldOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
