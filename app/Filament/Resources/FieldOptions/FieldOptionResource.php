<?php

namespace App\Filament\Resources\FieldOptions;

use App\Filament\Resources\FieldOptions\Pages\CreateFieldOption;
use App\Filament\Resources\FieldOptions\Pages\EditFieldOption;
use App\Filament\Resources\FieldOptions\Pages\ListFieldOptions;
use App\Filament\Resources\FieldOptions\Schemas\FieldOptionForm;
use App\Filament\Resources\FieldOptions\Tables\FieldOptionsTable;
use App\Models\FieldOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FieldOptionResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = FieldOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema
    {
        return FieldOptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FieldOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFieldOptions::route('/'),
            'create' => CreateFieldOption::route('/create'),
            'edit' => EditFieldOption::route('/{record}/edit'),
        ];
    }
}
