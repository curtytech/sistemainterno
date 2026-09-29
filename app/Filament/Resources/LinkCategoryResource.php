<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkCategoryResource\Pages;
use App\Models\LinkCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LinkCategoryResource extends Resource
{
    protected static ?string $model = LinkCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'Categorias de Links';

    protected static ?string $modelLabel = 'Categoria de Links';

    protected static ?string $pluralModelLabel = 'Categorias de Links';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados da Categoria')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título da categoria')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Placeholder::make('quantidade_links')
                            ->label('Quantidade de links')
                            ->hiddenOn('create')
                            ->content(function (LinkCategory $record) {
                                return (string) $record->links()->count();
                            })
                            ->columnSpanFull(),
                    ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                Tables\Columns\TextColumn::make('links_count')
                    ->label('Links')
                    ->counts('links')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizada em')
                    ->dateTime('d/m/Y H:i')
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
            'index'  => Pages\ListLinkCategories::route('/'),
            'create' => Pages\CreateLinkCategory::route('/create'),
            'edit'   => Pages\EditLinkCategory::route('/{record}/edit'),
        ];
    }
}
