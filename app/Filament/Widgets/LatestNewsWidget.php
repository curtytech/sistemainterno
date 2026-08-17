<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestNewsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                News::query()
                    ->with(['category'])
                    ->latest()
                    ->limit(6),
            )
            ->heading('Notícias recentes')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->label('Capa')
                    ->size(72),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Publicado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->url(fn (News $record): string => NewsResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false)
            ->emptyStateHeading('Nenhuma notícia cadastrada');
    }
}
