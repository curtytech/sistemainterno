<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Event;
use App\Models\News;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        return view('site.index', [
            'boards' => Board::query()
                ->latest()
                ->limit(15)
                ->get(),
            'eventos' => Event::query()
                ->future()
                ->limit(21)
                ->get(),
            'noticias' => News::query()
                ->published()
                ->limit(21)
                ->get(),
        ]);
    }

    public function newsIndex(): View
    {
        return view('site.news.index', [
            'noticias' => News::query()
                ->published()
                ->paginate(12),
        ]);
    }

    public function newsShow(News $news): View
    {
        $news->loadMissing('category:id,name');

        return view('site.news.show', [
            'noticia' => $news,
        ]);
    }

    public function eventsIndex(): View
    {
        return view('site.events.index', [
            'eventos' => Event::query()
                ->sortedForListing()
                ->paginate(12),
        ]);
    }

    public function eventsShow(Event $event): View
    {
        $event->loadMissing('category:id,name');

        return view('site.events.show', [
            'evento' => $event,
        ]);
    }

    public function contentIndex(): View
    {
        return view('site.content.index', [
            'noticias' => News::query()
                ->published()
                ->paginate(8, ['*'], 'noticias_pagina'),
            'eventos' => Event::query()
                ->sortedForListing()
                ->paginate(8, ['*'], 'eventos_pagina'),
        ]);
    }
}
