<?php

namespace App\Filament\Resources\SubmissionValues;

use App\Filament\Resources\SubmissionValues\Pages\CreateSubmissionValue;
use App\Filament\Resources\SubmissionValues\Pages\EditSubmissionValue;
use App\Filament\Resources\SubmissionValues\Pages\ListSubmissionValues;
use App\Filament\Resources\SubmissionValues\Schemas\SubmissionValueForm;
use App\Filament\Resources\SubmissionValues\Tables\SubmissionValuesTable;
use App\Models\SubmissionValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubmissionValueResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = SubmissionValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SubmissionValueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubmissionValuesTable::configure($table);
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
            'index' => ListSubmissionValues::route('/'),
            'create' => CreateSubmissionValue::route('/create'),
            'edit' => EditSubmissionValue::route('/{record}/edit'),
        ];
    }
}
