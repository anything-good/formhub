<?php

namespace App\Filament\Resources\Forms\RelationManagers;

use App\Filament\Resources\Forms\Widgets\SubmissionCountWidget;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                DateTimePicker::make('submitted_at')
                    ->required(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        $form = $this->ownerRecord;

        $components = [];

        foreach ($form->fields as $field) {
            $components[] =
                TextEntry::make('field_' . $field->id)
                    ->label($field->label)
                    ->content(
                        fn($record) =>
                        $record->values()
                            ->where('field_id', $field->id)
                            ->first()
                                ?->value ?? '—'
                    );
        }

        return $schema->components($components);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
                // add number of submissions badge
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
