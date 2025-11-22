<?php

namespace App\Filament\Resources\SubmissionValues\Pages;

use App\Filament\Resources\SubmissionValues\SubmissionValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSubmissionValue extends EditRecord
{
    protected static ?string $resource = SubmissionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
