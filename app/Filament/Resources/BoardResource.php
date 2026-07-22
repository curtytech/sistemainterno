<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardResource\Pages;
use App\Filament\Resources\BoardResource\RelationManagers;
use App\Models\Board;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BoardResource extends Resource
{
    protected static ?string $model = Board::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'Boards';

    protected static ?string $modelLabel = 'Board';

    protected static ?string $pluralModelLabel = 'Boards';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('ID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->label('Titulo')
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->label('Conteudo')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('image')
                    ->label('Imagem (URL)')
                    ->url()
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Link')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('file')
                    ->label('Arquivo')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->label('Arquivo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ]),
            ]);
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
            'index' => Pages\ListBoards::route('/'),
            'create' => Pages\CreateBoard::route('/create'),
            'edit' => Pages\EditBoard::route('/{record}/edit'),
        ];
    }
}
