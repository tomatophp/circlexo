<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Account;

class CircleXOController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('circle-xo::index');
    }

    public function menu()
    {
        return view('circle-xo::menu');
    }

    public function profile($username)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            return view('circle-xo::profile', compact('account'));
        }
        else {
            abort(404);
        }
    }
}
