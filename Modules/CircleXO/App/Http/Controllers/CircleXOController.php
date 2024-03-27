<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Account;
use Modules\CircleXO\App\Models\AccountContact;
use Modules\CircleXO\App\Models\AccountListing;
use ProtoneMedia\Splade\Facades\Toast;

class CircleXOController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('circle-xo::index');
    }

    public function verify(Account $account)
    {
        if($account->type === 'verified'){
            $account->type = 'customer';
            $account->save();
        }
        else {
            $account->type = 'verified';
            $account->save();
        }

        Toast::success('Account Verified Successfully')->autoDismiss(2);
        return redirect()->back();
    }



    public function sponsoring($username)
    {
        $account = Account::where('username', $username)->first();
        if($account && $account->meta('sponsoring_message') && $account->meta('sponsoring_link')){
            return view('circle-xo::sponsoring', compact('account'));
        }
        else {
            abort(404);
        }
    }

    public function contact($username)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            return view('circle-xo::contact', compact('account'));
        }
        else {
            abort(404);
        }
    }

    public function post($username, $post)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            $post = AccountListing::where('account_id', $account->id)
                ->where('type', 'post')
                ->where('id', $post)
                ->first();

            if($post){
                return view('circle-xo::post', compact('account', 'post'));
            }
            else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }

    public function send($username, Request $request)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            $request->validate([
                "message" => "required|string",
                "anonymous_message" => "required|boolean"
            ]);

            if(!$request->get('anonymous_message')){
                $request->validate([
                    "name" => "required|string|max:255",
                    "email" => "required|email|max:255",
                ]);
            }

            $contact = new AccountContact();
            $contact->account_id = $account->id;
            if(auth('accounts')->user() && !$request->get('anonymous_message')){
                $contact->sender_id = auth('accounts')->user()->id;
                $contact->name = auth('accounts')->user()->name;
                $contact->email = auth('accounts')->user()->email;
            }
            else {
                $contact->name = $request->get('name');
                $contact->email = $request->get('email');
            }

            $contact->message = $request->get('message');
            $contact->anonymous_message = $request->get('anonymous_message');
            $contact->save();

            $account->notifyDB(
                message: $contact->message,
                title: __('You have a new message'),
                url: url('profile/messages')
            );

            Toast::success('Message Sent Successfully')->autoDismiss(2);
            return redirect()->back();

        }
        else {
            abort(404);
        }
    }

    public function profile($username, Request $request)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            $query = AccountListing::query();
            if($request->has('type') && $request->get('type') && $request->get('type') !== 'all'){
                $query->where('type', $request->get('type'));
            }
            $listing = $query->where('account_id', $account->id)
                ->where('is_active', true)
                ->inRandomOrder()
                ->paginate(12);

            return view('circle-xo::profile', compact('account', 'listing'));
        }
        else {
            abort(404);
        }
    }
}
