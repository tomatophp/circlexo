<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('circle-xo::profile.index');
    }

    public function avatar()
    {
        return view('circle-xo::profile.edit.avatar');
    }

    public function cover()
    {
        return view('circle-xo::profile.edit.cover');
    }


    public function info()
    {
        return view('circle-xo::profile.edit.info');
    }

    public function social()
    {
        return view('circle-xo::profile.edit.social');
    }


    public function updateInfo(Request $request)
    {
        if(!empty($request->get('username'))){
            $request->merge([
                "username" => '@'.strtolower($request->get('username')),
            ]);
        }

        $request->validate([
            "name" => "required|string|max:255",
            "bio" => "nullable|string|max:255",
            "username" => "required|string|max:255|unique:accounts,username,".auth('accounts')->id(),
            "email" => "required|string|email|max:255|unique:accounts,email,".auth('accounts')->id(),
        ]);

        $account = auth('accounts')->user();

        $account->update($request->all());

        if($request->has('bio') && !empty($request->get('bio'))){
            $account->meta('bio', $request->get('bio'));
        }
        else {
            $account->metaDestroy('bio');
        }

        Toast::success('Profile updated successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function updateMeta(Request $request)
    {
        $account = auth('accounts')->user();

        if($request->has('social')){
            $account->meta('social', $request->get('social'));
        }

        Toast::success('Profile updated successfully')->autoDismiss(2);
        return redirect()->back();

    }

    public function updateMedia(Request $request)
    {
        $account = auth('accounts')->user();

        if($request->hasFile('avatar') && $request->file('avatar')->getClientOriginalName() !== 'blob'){
            $request->validate([
                'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $account->clearMediaCollection('avatar');
            $account->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        else if($request->has('avatar') && empty($request->get('avatar'))){
            $account->clearMediaCollection('avatar');
        }

        if($request->hasFile('cover') && $request->file('cover')->getClientOriginalName() !== 'blob'){
            $request->validate([
                'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $account->clearMediaCollection('cover');
            $account->addMedia($request->file('cover'))->toMediaCollection('cover');
        }
        else if($request->has('cover') && empty($request->get('cover'))){
            $account->clearMediaCollection('cover');
        }

        Toast::success('Profile updated successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function logout()
    {
        auth('accounts')->logout();
        return redirect()->route('account.login');
    }
}
