<?php

namespace App\Filament\Resources\Forms\Schemas;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;

class FormForm
{
    public static function configure($form)
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->hidden()
                    ->default(fn() => Auth::id())
                    ->dehydrateStateUsing(fn() => Auth::id())
                    ->required(),

                TextInput::make('title')
                    ->label('Form Title')
                    ->required()
                    ->maxLength(255),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'closed' => 'Closed',
                    ])
                    ->default('draft'),

                Textarea::make('description')
                    ->label('Form Description')
                    ->maxLength(1000)
                    ->columnSpanFull(),

                // Fields Repeater
                Repeater::make('fields')
                    ->relationship() // Link to Eloquent relationship
                    ->label('Form Fields')
                    ->schema([
                        TextInput::make('label')
                            ->label('Field Label')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Field Type')
                            ->options([
                                'text' => 'Text',
                                'email' => 'Email',
                                'dropdown' => 'Dropdown',
                                'checkbox' => 'Checkbox',
                                'radio' => 'Radio',
                                'rating' => 'Rating',
                                'datetime' => 'Date Time',
                            ])
                            ->required(),

                        // Options Repeater
                        Repeater::make('options')
                            ->relationship() // Link to field options table
                            ->label('Options')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Option Label')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->orderable(),
                    ])
                    ->orderable(),
            ]);
    }
}

