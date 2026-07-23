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
            'boards' => Board::getLatestForSite(5),
            'eventos' => Event::getLatestForSite(3),
            'noticias' => News::getLatestForSite(4),
        ]);
    }
}
