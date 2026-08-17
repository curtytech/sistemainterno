<?php

namespace App\Filament\Widgets;

use App\Models\Board;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $boards = Board::count();
        $noticias = News::count();
        $eventos = Event::count();
        $usuarios = User::count();

        $noticiasUltimos7Dias = News::whereDate('created_at', '>=', now()->subDays(7))->count();
        $eventosFuturos = Event::whereDate('start_date', '>=', now()->toDateString())->count();
        $admins = User::where('role', 'admin')->count();

        return [
            Stat::make('Banners (Boards)', $boards)
                ->description('Total cadastrado')
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->color('primary')
                ->chart([$boards > 0 ? 1 : 0, $boards]),
            Stat::make('Notícias', $noticias)
                ->description("{$noticiasUltimos7Dias} novas nos últimos 7 dias")
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('success')
                ->chart([0, min($noticias, 5), $noticias]),
            Stat::make('Eventos', $eventos)
                ->description("{$eventosFuturos} eventos futuros")
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('warning')
                ->chart([0, $eventosFuturos, $eventos]),
            Stat::make('Usuários', $usuarios)
                ->description("{$admins} administradores")
                ->descriptionIcon('heroicon-o-users')
                ->color('info')
                ->chart([0, $admins, $usuarios]),
        ];
    }
}
