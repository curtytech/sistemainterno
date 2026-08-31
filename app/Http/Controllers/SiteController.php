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
            'boards' => Board::getLatestForSite(15),
            'eventos' => Event::getLatestForSite(3),
            'noticias' => News::getLatestForSite(4),
        ]);
    }

    public function newsIndex(): View
    {
        return view('site.news.index', [
            'noticias' => News::query()
                ->with('category:id,name')
                ->latest()
                ->paginate(12),
        ]);
    }

    public function newsShow(News $news): View
    {
        $news->load('category:id,name');

        return view('site.news.show', [
            'noticia' => $news,
        ]);
    }

    public function eventsIndex(): View
    {
        return view('site.events.index', [
            'eventos' => Event::query()
                ->with('category:id,name')
                ->latest()
                ->paginate(12),
        ]);
    }

    public function eventsShow(Event $event): View
    {
        $event->load('category:id,name');

        return view('site.events.show', [
            'evento' => $event,
        ]);
    }

    public function contentIndex(): View
    {
        return view('site.content.index', [
            'noticias' => News::query()
                ->with('category:id,name')
                ->latest()
                ->paginate(8, ['*'], 'noticias_pagina'),
            'eventos' => Event::query()
                ->with('category:id,name')
                ->latest()
                ->paginate(8, ['*'], 'eventos_pagina'),
        ]);
    }
}
