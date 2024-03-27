<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TomatoCms\App\Models\Page;
use ProtoneMedia\Splade\Facades\SEO;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('circle-xo::page', compact('page'));
    }
}
