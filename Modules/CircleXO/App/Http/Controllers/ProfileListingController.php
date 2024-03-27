<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CircleXO\App\Models\AccountListing;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileListingController extends Controller
{
    private string $modal = AccountListing::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('circlexo::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('circle-xo::listing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "title" => "required|string|max:255",
            "image" => "nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",
            "type" => "required|string|in:link,product,service,skill,portfolio,review,post,music,video,game",
        ]);

        if($request->get('type') === 'post'){
            $request->validate([
                "body" => "required|string",
            ]);
        }
        else if($request->get('type') === 'product' || $request->get('type') === 'service'){
            $request->validate([
                "price" => "required|numeric|min:0",
                "currency" => "required|string|max:255",
                "url" => "required|url|max:255",
            ]);
        }
        else if($request->get('type') === 'review'){
            $request->validate([
                "description" => "required|string|max:255",
            ]);
        }
        else if($request->get('type') === 'link' || $request->get('type') === 'portfolio'){
            $request->validate([
                "url" => "required|url|max:255",
            ]);
        }

        $lastListing = AccountListing::where('account_id', auth('accounts')->id())->orderBy('order', 'desc')->first();
        $listing = new AccountListing();
        $listing->title = $request->get('title');
        $listing->type = $request->get('type');
        $listing->body = $request->get('body') ?? null;
        $listing->url = $request->get('url') ?? null;
        $listing->currency = $request->get('currency') ?? null;
        $listing->icon = $request->get('icon') ?? null;
        $listing->color = $request->get('color') ?? null;
        $listing->price = $request->get('price') ?? 0;
        $listing->discount = $request->get('discount') ?? 0;
        $listing->description = $request->get('description') ?? null;
        $listing->is_active = $request->get('is_active');
        $listing->order = $lastListing ? $lastListing->order+1 : 0;
        $listing->account_id = auth()->id();
        $listing->save();

        if($listing->is_active){
            $followers = auth('accounts')->user()->followers()->get();
            foreach ($followers as $follower){
                $follower->notifyDB(
                    message: auth('accounts')->user()->username . " " . __('Just add new listing'),
                    title: __('New Listing'),
                    url: url(auth('accounts')->user()->username)
                );
            }
        }

        if($request->hasFile('image')){
            $listing->addMediaFromRequest('image')->toMediaCollection('image');
        }

        Toast::success('Listing created successfully')->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('circlexo::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountListing $listing)
    {
        return view('circle-xo::listing.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountListing $listing): RedirectResponse
    {
        $request->validate([
            "title" => "required|string|max:255",
            "image" => "nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",
            "type" => "required|string|in:link,product,service,skill,portfolio,review,post,music,video,game",
        ]);

        if($request->get('type') === 'post'){
            $request->validate([
                "body" => "required|string",
            ]);
        }
        else if($request->get('type') === 'product' || $request->get('type') === 'service'){
            $request->validate([
                "price" => "required|numeric|min:0",
                "currency" => "required|string|max:255",
                "url" => "required|url|max:255",
            ]);
        }
        else if($request->get('type') === 'review'){
            $request->validate([
                "description" => "required|string|max:255",
            ]);
        }
        else if($request->get('type') === 'link' || $request->get('type') === 'portfolio'){
            $request->validate([
                "url" => "required|url|max:255",
            ]);
        }

        $listing->update($request->all());

        if($listing->is_active){
            $followers = auth('accounts')->user()->followers()->get();
            foreach ($followers as $follower){
                $follower->notifyDB(
                    message: auth('accounts')->user()->username . " " . __('Just update listing'),
                    title: __('Update Listing'),
                    url: url(auth('accounts')->user()->username)
                );
            }
        }

        if($request->hasFile('image') && $request->file('image')->getClientOriginalName() !== 'blob'){
            $listing->clearMediaCollection('image');
            $listing->addMediaFromRequest('image')->toMediaCollection('image');
        }

        Toast::success('Listing updated successfully')->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountListing $listing): RedirectResponse
    {
        $listing->delete();
        Toast::success('Listing deleted successfully')->autoDismiss(2);
        return redirect()->back();
    }
}
