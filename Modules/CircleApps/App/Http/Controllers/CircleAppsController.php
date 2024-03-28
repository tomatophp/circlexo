<?php

namespace Modules\CircleApps\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CircleApps\App\Models\App;
use ProtoneMedia\Splade\Facades\Toast;

class CircleAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apps= App::query();
        if($request->has('search')) {
            $apps->where('name', 'like', '%'.$request->search.'%');
        }
        if($request->has('category')) {
            $apps->whereHas('categories', function ($query) use ($request) {
                $query->where('id', $request->category);
            });
        }
        $apps->where('is_active', true);
        $apps->orderBy('id', 'desc');
        $apps = $apps->paginate(12);

        return view('circle-apps::index', compact('apps'));
    }

    /**
     * Show the specified resource.
     */
    public function show(App $app)
    {
        return view('circle-apps::show', compact('app'));
    }

    public function install(App $app)
    {
        auth('accounts')->user()->apps()->attach($app->id);

        Toast::success(__('App installed successfully!'))->autoDismiss(2);
        return back();
    }

    public function uninstall(App $app)
    {
        auth('accounts')->user()->apps()->detach($app->id);

        Toast::success(__('App installed successfully!'))->autoDismiss(2);
        return back();
    }
}
