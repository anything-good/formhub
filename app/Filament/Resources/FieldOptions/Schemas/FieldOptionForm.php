<?php

namespace App\Filament\Resources\FieldOptions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FieldOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('field_id')
                    ->required()
                    ->numeric(),
                TextInput::make('label')
                    ->required(),
                TextInput::make('value'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
