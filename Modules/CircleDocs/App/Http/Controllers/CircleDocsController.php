<?php

namespace Modules\CircleDocs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CircleDocs\App\Models\CircleXoDoc;

class CircleDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CircleXoDoc::query();
        $query->where('is_public', true);
        if($request->has('search') && $request->input('search') != ''){
            $query->where('name', 'like', '%'.$request->input('search').'%')->orWhere('package', 'like', '%'.$request->input('search').'%');
        }
        $query->where('is_public', true);
        $query = $query->paginate(12);

        return view('circle-docs::index', [
            'docs' => $query
        ]);
    }

    public function profile($username)
    {
        $account = Account::where('username', $username)->firstOrFail();
        if($account){
            $query = CircleXoDoc::query();
            $query->where('account_id', $account->id);
            $query->where('is_public', true);
            $query = $query->paginate(12);

            return view('circle-docs::profile', [
                'docs' => $query,
                'account' => $account
            ]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($username, $slug)
    {
        $account = Account::where('username', $username)->firstOrFail();
        if($account){
            $doc = CircleXoDoc::where('package', $slug)->where('account_id', $account->id)->firstOrFail();
            return view('circle-docs::show', [
                'doc' => $doc,
                'account' => $account
            ]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function page($username, $slug, $page)
    {
        $account = Account::where('username', $username)->firstOrFail();
        if($account){
            $doc = CircleXoDoc::where('package', $slug)->where('account_id', $account->id)->firstOrFail();
            if($doc){
                $page = $doc->pages()->where('slug', $page)->firstOrFail();
                return view('circle-docs::show', [
                    'doc' => $doc,
                    'currentPage' => $page,
                    'account' => $account
                ]);
            }
        }
    }
}
