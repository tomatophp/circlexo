<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Account;
use Modules\CircleXO\App\Models\AccountContact;
use Modules\CircleXO\App\Models\AccountListing;
use Modules\TomatoCms\App\Models\Page;
use Modules\TomatoSupport\App\Models\Question;
use ProtoneMedia\Splade\Facades\Toast;

class CircleXOController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = Page::where('slug', '/')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Home Page';
            $page->slug = '/';
            $page->is_active = true;
            $page->save();
        }
        return view('circle-xo::index', compact('page'));
    }

    public function marketplace(Request $request)
    {
        $query = AccountListing::query();
        $query->with('account')->where('type', 'product')->orWhere('type', 'service')->where('is_active', true);
        if($request->has('search') && !empty($request->get('search'))){
            $query->where('title', 'LIKE', '%'.$request->get('search').'%');
        }

        $products = $query->orderBy('id', 'desc')->paginate(10);

        return view('circle-xo::marketplace', compact('products'));
    }

    public function blog(Request $request)
    {
        $query = AccountListing::query();
        $query->with('account')->where('type', 'post')->where('is_active', true);
        if($request->has('search') && !empty($request->get('search'))){
            $query->where('title', 'LIKE', '%'.$request->get('search').'%');
        }

        $posts = $query->orderBy('id', 'desc')->paginate(10);

        return view('circle-xo::blog', compact('posts'));
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
                if(auth('accounts')->user()){
                    auth('accounts')->user()->view($post);
                }
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
            if($request->has('hashtag') && $request->get('hashtag')){
                $query->where('description','LIKE', '%'.$request->get('hashtag').'%');
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

    public function like($username, $post)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            $post = AccountListing::where('account_id', $account->id)
                ->where('id', $post)
                ->first();

            if($post){
                if($post->account->id !== auth('accounts')->user()->id) {
                    $post->account->notifyDB(
                        message: __(auth('accounts')->user()->username . " " . __('is like your listing') . ' ' . $post->title),
                        title: __('New Like'),
                        url: url(auth('accounts')->user()->username)
                    );
                }

                auth('accounts')->user()->like($post);
                return back();
            }
            else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }

    public function unlike($username, $post)
    {
        $account = Account::where('username', $username)->first();
        if($account){
            $post = AccountListing::where('account_id', $account->id)
                ->where('id', $post)
                ->first();

            if($post){
                if($post->account->id !== auth('accounts')->user()->id){
                    $post->account->notifyDB(
                        message: __(auth('accounts')->user()->username . " " . __('is dislike your listing') .' '. $post->title),
                        title: __('New Dislike'),
                        url: url(auth('accounts')->user()->username)
                    );
                }

                auth('accounts')->user()->unlike($post);
                return back();
            }
            else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }

    public function faq(Request $request)
    {
        if(class_exists(\Modules\TomatoSupport\App\Models\Question::class)){
            $page = Page::where('slug', '/faq')->first();
            if(!$page){
                $page = new Page();
                $page->title = 'FAQ';
                $page->slug = '/faq';
                $page->is_active = true;
                $page->save();
            }
            $questions = Question::query();

            if($request->has('search')){
                $questions->where('qa', 'like', "%{$request->get('search')}%");
            }

            $questions = $questions->paginate(12);

            return view('circle-xo::builder', compact('questions', 'page'));
        }
        else {
            return redirect()->to('/');
        }

    }

    public function terms()
    {
        $page = Page::where('slug', '/terms')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Terms';
            $page->slug = '/terms';
            $page->is_active = true;
            $page->save();
        }
        return view('circle-xo::builder', compact('page'));
    }

    public function privacy()
    {
        $page = Page::where('slug', '/privacy')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Privacy';
            $page->slug = '/privacy';
            $page->is_active = true;
            $page->save();
        }
        return view('circle-xo::builder', compact('page'));
    }
}
