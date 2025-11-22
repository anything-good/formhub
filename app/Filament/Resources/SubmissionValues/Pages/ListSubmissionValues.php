<?php

namespace App\Filament\Resources\SubmissionValues\Pages;

use App\Filament\Resources\SubmissionValues\SubmissionValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubmissionValues extends ListRecords
{
    protected static ?string $resource = SubmissionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
