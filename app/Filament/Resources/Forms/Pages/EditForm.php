<?php

namespace App\Filament\Resources\Forms\Pages;

use App\Filament\Resources\Forms\FormResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditForm extends EditRecord
{
    protected static ?string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
            Action::make('formLink')
                ->label('Form Link')
                ->url(fn(): string => url('/forms/' . $this->record->getKey()))
                ->icon('heroicon-o-link')
                // ->copyable()
                ->openUrlInNewTab(),
        ];
    }


    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Resources\Forms\Widgets\SubmissionCountChart::class,
            \App\Filament\Resources\Forms\Widgets\FieldResultsChart::class,
        ];
    }
}
