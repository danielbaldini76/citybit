<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Anagrafica';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Codice')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('vat')
                    ->label('P.IVA')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->label('Indirizzo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('Città')
                    ->maxLength(255),
                Forms\Components\TextInput::make('province')
                    ->label('Provincia')
                    ->maxLength(50),
                Forms\Components\Toggle::make('is_active')
                    ->label('Attivo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Codice')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vat')
                    ->label('P.IVA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Città')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Attivo'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Attivo')
                    ->trueLabel('Solo attivi')
                    ->falseLabel('Solo disattivi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
