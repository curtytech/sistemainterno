<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'Links';

    protected static ?string $modelLabel = 'Link';

    protected static ?string $pluralModelLabel = 'Links';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados do Link')
                    ->schema([
                        Forms\Components\Select::make('link_category_id')
                            ->label('Categoria')
                            ->required()
                            ->relationship('category', 'title')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->label('Título da categoria')
                                    ->required()
                                    ->unique()
                                    ->maxLength(255),
                            ])
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('link')
                            ->label('Link')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-globe-alt'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->searchable()
                    ->url(fn (Link $record): string => $record->link)
                    ->openUrlInNewTab()
                    ->limit(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('link_category_id')
                    ->label('Categoria')
                    ->relationship('category', 'title')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
