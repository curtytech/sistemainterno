<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentLibraryResource\Pages;
use App\Models\DocumentLibrary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentLibraryResource extends Resource
{
    protected static ?string $model = DocumentLibrary::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'Biblioteca de Documentos';

    protected static ?string $modelLabel = 'Documento';

    protected static ?string $pluralModelLabel = 'Biblioteca de Documentos';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados do documento')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('link')
                            ->label('Link')
                            ->url()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('icon')
                            ->label('Ícone')
                            ->helperText('Envie uma imagem para representar o documento.')
                            ->image()
                            ->disk('public')
                            ->directory('document-library/icons')
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link')
                    ->searchable()
                    ->url(fn (DocumentLibrary $record): string => $record->link)
                    ->openUrlInNewTab()
                    ->limit(50),
                Tables\Columns\ImageColumn::make('icon_url')
                    ->label('Ícone')
                    ->height(40)
                    ->width(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentLibraries::route('/'),
            'create' => Pages\CreateDocumentLibrary::route('/create'),
            'edit' => Pages\EditDocumentLibrary::route('/{record}/edit'),
        ];
    }
}
