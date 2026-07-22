<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        return view('site.index', [
            'eventos' => Event::getLatestForSite(3),
            'noticias' => News::getLatestForSite(4),
        ]);
    }
}
