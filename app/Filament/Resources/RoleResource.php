<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Anagrafica';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('label')
                    ->label('Etichetta')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_system')
                    ->label('Di sistema')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Etichetta')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_system')
                    ->label('Di sistema')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('insert')
                        ->label('Inserisci')
                        ->icon('heroicon-o-document-duplicate')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $baseName = $record->name . '_copy';
                                $newName = $baseName;
                                $counter = 1;
                                
                                // Ensure unique name
                                while (Role::where('name', $newName)->exists()) {
                                    $newName = $baseName . '_' . $counter;
                                    $counter++;
                                }
                                
                                Role::create([
                                    'name' => $newName,
                                    'label' => $record->label,
                                    'is_system' => false,
                                ]);
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
