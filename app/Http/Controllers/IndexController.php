<?php

namespace App\Http\Controllers;

use App\Services\RssReaderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    public function index(RssReaderService $rssReaderService)
    {
        return view('index', ['items' => $rssReaderService->read()]);
    }
}
