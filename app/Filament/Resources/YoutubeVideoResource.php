<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YoutubeVideoResource\Pages;
use App\Models\YoutubeVideo;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class YoutubeVideoResource extends Resource
{
    protected static ?string $model = YoutubeVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'Vídeos do YouTube';

    protected static ?string $modelLabel = 'Vídeo do YouTube';

    protected static ?string $pluralModelLabel = 'Vídeos do YouTube';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('folder')
                    ->label('Imagem de capa')
                    ->disk('public')
                    ->directory('youtube-videos/images')
                    ->image()
                    ->imageEditor(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link')
                    ->label('Link do YouTube')
                    ->helperText('Aceita links youtube.com/watch, youtu.be, shorts, live ou embed.')
                    ->url()
                    ->required()
                    ->maxLength(255)
                    ->rules([
                        function (): Closure {
                            return function (string $attribute, mixed $value, Closure $fail): void {
                                if (YoutubeVideo::extractVideoId($value) === null) {
                                    $fail('Informe um link válido de vídeo do YouTube.');
                                }
                            };
                        },
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('folder')
                    ->label('Capa')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link do YouTube')
                    ->url(fn (YoutubeVideo $record): ?string => YoutubeVideo::extractVideoId($record->link) ? $record->link : null)
                    ->openUrlInNewTab()
                    ->limit(45),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListYoutubeVideos::route('/'),
            'create' => Pages\CreateYoutubeVideo::route('/create'),
            'edit' => Pages\EditYoutubeVideo::route('/{record}/edit'),
        ];
    }
}
