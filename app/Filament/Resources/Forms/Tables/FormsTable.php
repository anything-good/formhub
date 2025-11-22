<?php

namespace App\Filament\Resources\Forms\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FormsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Form Title')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('submissions_count')
                    ->label('Submissions')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->submissions()->count()),
                TextColumn::make('description')->label('Description')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('duplicate')
                    ->icon(Heroicon::DocumentDuplicate)
                    ->color('blue')
                    ->action(function ($oldForm, $livewire) {

                        $newForm = $oldForm->replicate();
                        $newForm->title = $oldForm->title . " copy";
                        $newForm->save();

                        // Duplicate fields
                        foreach ($oldForm->fields as $field) {
                            $newField = $field->replicate();
                            $newField->form_id = $newForm->id;
                            $newField->save();

                            // Duplicate field options (if exists)
                            foreach ($field->options as $option) {
                                $newOption = $option->replicate();
                                $newOption->field_id = $newField->id;
                                $newOption->save();
                            }
                        }


                        return redirect($livewire->getResource()::getUrl('edit', ['record' => $newForm]));
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
