<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PdfResource\Pages;
use App\Models\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PdfResource extends Resource
{
    protected static ?string $model = Pdf::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'PDFs';

    protected static ?string $modelLabel = 'PDF';

    protected static ?string $pluralModelLabel = 'PDFs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file')
                    ->label('Arquivo PDF')
                    ->disk('public')
                    ->directory('pdfs/files')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(20480)
                    ->downloadable()
                    ->openable()
                    ->required()
                    ->columnSpanFull(),
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
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->label('Arquivo')
                    ->searchable()
                    ->url(fn (Pdf $record): ?string => $record->file_url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
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
            'index' => Pages\ListPdfs::route('/'),
            'create' => Pages\CreatePdf::route('/create'),
            'edit' => Pages\EditPdf::route('/{record}/edit'),
        ];
    }
}
