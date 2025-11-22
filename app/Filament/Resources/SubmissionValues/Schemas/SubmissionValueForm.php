<?php

namespace App\Filament\Resources\SubmissionValues\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SubmissionValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('submission_id')
                    ->required()
                    ->numeric(),
                TextInput::make('field_id')
                    ->required()
                    ->numeric(),
                Textarea::make('value')
                    ->columnSpanFull(),
                TextInput::make('option_id')
                    ->numeric(),
            ]);
    }
}
