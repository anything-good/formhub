<?php

namespace App\Filament\Resources\FormSubmissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;

class FormSubmissionForm
{
    public static function configure($form)
    {
        return $form
            ->schema([

                DateTimePicker::make('submitted_at')
                    ->label('Submitted At')
                    ->disabled()
                    ->columnSpanFull(),

                Repeater::make('values')
                    ->relationship('values')
                    ->label('Submitted Values')
                    ->schema([


                        Placeholder::make('field_label')
                            ->label('Field')
                            ->content(fn($record) => $record?->field?->name ?? $record?->option?->label ?? $record?->option?->title ?? '—'),

                        Placeholder::make('answer')
                            ->label('Answer')
                            ->content(fn($record) => is_array($record?->value)
                                ? implode(', ', $record->value)
                                : (string) ($record?->value ?? '—')),
                    ])
                    ->columns(2)
                    ->disableLabel(),
            ]);
    }
}
