<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Carbon;

class UpcomingEventsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::query()
                    ->with(['category'])
                    ->whereDate('end_date', '>=', now()->toDateString())
                    ->orWhere(function ($query) {
                        $query
                            ->whereNull('end_date')
                            ->whereDate('start_date', '>=', now()->toDateString());
                    })
                    ->orderByRaw('COALESCE(start_date, created_at) asc')
                    ->limit(6),
            )
            ->heading('Próximos eventos')
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
                    ->color('warning'),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Data de início')
                    ->date('d/m/Y')
                    ->formatStateUsing(fn (?string $state) => $state ? Carbon::parse($state)->format('d/m/Y') : '-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Data de fim')
                    ->formatStateUsing(fn (?string $state) => $state ? Carbon::parse($state)->format('d/m/Y') : '-'),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Hora início')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Hora fim')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Event $record): string => EventResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false)
            ->emptyStateHeading('Nenhum evento futuro cadastrado');
    }
}
