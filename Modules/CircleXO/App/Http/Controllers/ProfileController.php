<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tables\AccountContactTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\CircleXO\App\Models\AccountContact;
use Modules\CircleXO\App\Models\AccountListing;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\Facades\Toast;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AccountListing::query();
        if($request->has('type') && $request->get('type') && $request->get('type') !== 'all'){
            $query->where('type', $request->get('type'));
        }
        $listing = $query->where('account_id', auth('accounts')->id())
            ->inRandomOrder()
            ->paginate(12);
        return view('circle-xo::profile.index', compact('listing'));
    }

    public function sponsoring()
    {
        return view('circle-xo::profile.edit.sponsoring');
    }

    public function socialAccounts()
    {
        return view('circle-xo::profile.edit.social-accounts');
    }

    public function socialAccountsUpdate(Request $request)
    {
        $request->validate([
            "provider" => "required|string|in:discord,twitter-oauth-2,github",
        ]);

        $account = auth('accounts')->user();
        $account->metaDestroy($request->get('provider').'_id');
        $account->metaDestroy($request->get('provider').'_token');
        $account->metaDestroy($request->get('provider').'_refresh_token');

        Toast::success('Social account removed successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function following(Request $request)
    {
        return view('circle-xo::profile.following');
    }

    public function followers(Request $request)
    {
        return view('circle-xo::profile.followers');
    }

    public function messages(Request $request)
    {
        return view('circle-xo::profile.messages', [
            'table' => (new AccountContactTable(auth('accounts')->id()))
        ]);
    }

    public function message(Request $request, AccountContact $message)
    {
        return view('circle-xo::profile.message', compact('message'));
    }

    public function qr()
    {
        $qr = QrCode::format('png')
            ->margin(2)
            ->eye('circle')
            ->backgroundColor(0, 0, 0)
            ->style('round')
            ->color(248,207,0)
            ->size(200)
            ->generate(url('/' . auth('accounts')->user()->username));

        return view('circle-xo::profile.edit.qr', compact('qr'));
    }

    public function hexToRGB(string $hex): array
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return [$r,$g,$b];
    }

    public function qrUpdate(Request $request)
    {
        $request->validate([
            "background" => "required|string",
            "color" => "required|string",
            "margin" => "required|integer",
            "eye" => "required|string",
            "style" => "required|string",
            "size" => "required|integer",
        ]);

        $account = auth('accounts')->user();
        $account->meta('qr.background', $request->get('background'));
        $account->meta('qr.color', $request->get('color'));
        $account->meta('qr.margin', $request->get('margin'));
        $account->meta('qr.eye', $request->get('eye'));
        $account->meta('qr.style', $request->get('style'));
        $account->meta('qr.size', $request->get('size'));

        $bg = $this->hexToRGB($request->get('background'));
        $color = $this->hexToRGB($request->get('color'));
        $qr = QrCode::format('png')
            ->margin($request->get('margin'))
            ->eye($request->get('eye'))
            ->backgroundColor($bg[0], $bg[1], $bg[2])
            ->style($request->get('style'))
            ->color($color[0], $color[1], $color[2])
            ->size($request->get('size'))
            ->generate(url('/' . auth('accounts')->user()->username));

        return view('circle-xo::profile.edit.qr-print', compact('qr'));
    }

    public function avatar()
    {
        return view('circle-xo::profile.edit.avatar');
    }

    public function password()
    {
        return view('circle-xo::profile.edit.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "current_password" => "required|string|min:8",
            "password" => "required|string|min:8|confirmed",
        ]);

        if(!password_verify($request->get('current_password'), auth('accounts')->user()->password)){
            Toast::danger('Current password is incorrect')->autoDismiss(2);
            return redirect()->back();
        }

        $account = auth('accounts')->user();
        $account->password = bcrypt($request->get('password'));
        $account->save();

        Toast::success('Password updated successfully')->autoDismiss(2);
        return redirect()->back();
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

    public function socialStore(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "link" => "required|string|url|max:255",
            "label" => "required|string|max:255"
        ]);

        $account = auth('accounts')->user();
        $social = $account->meta('social');
        $social[] = [
            'name' => $request->get('name'),
            'link' => $request->get('link'),
            'label' => $request->get('label'),
        ];
        $account->meta('social', $social);

        Toast::success('Social account added successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function socialEdit($network)
    {
        $network = collect(auth('accounts')->user()->meta('social'))->where('name', $network)->first();
        return view('circle-xo::profile.edit.social-edit', compact('network'));
    }

    public function socialUpdate(Request $request, $network)
    {
        $request->validate([
            "name" => "required|string",
            "link" => "required|string|url|max:255",
            "label" => "required|string|max:255"
        ]);

        $account = auth('accounts')->user();
        $social = $account->meta('social');
        foreach ($social as $key=>$item){
            if($item['name'] === $network){
                $social[$key] = [
                    'name' => $request->get('name'),
                    'link' => $request->get('link'),
                    'label' => $request->get('label'),
                ];
            }
        }
        $account->meta('social', $social);

        Toast::success('Social account updated successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function socialDestroy(Request $request, $network)
    {
        $account = auth('accounts')->user();
        $social = $account->meta('social');
        foreach ($social as $key=>$item){
            if($item['name'] === $network){
                 unset($social[$key]);
            }
        }
        $account->meta('social', $social);

        Toast::success('Social account removed successfully')->autoDismiss(2);
        return redirect()->back();
    }

    public function updateMeta(Request $request)
    {
        $account = auth('accounts')->user();

        if($request->has('social')){
            $account->meta('social', $request->get('social'));
        }

        if($request->has('sponsoring_link') || $request->has('sponsoring_message')){
            $account->meta('sponsoring_message', $request->get('sponsoring_message'));
            $account->meta('sponsoring_link', $request->get('sponsoring_link'));
        }

        Toast::success('Profile updated successfully')->autoDismiss(2);
        return redirect()->back();

    }

    public function updateMedia(Request $request)
    {
        $account = auth('accounts')->user();

        if($request->hasFile('avatar') && $request->file('avatar')->getClientOriginalName() !== 'blob'){
            $request->validate([
                'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $account->clearMediaCollection('avatar');
            $account->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        else if($request->has('avatar') && empty($request->get('avatar'))){
            $account->clearMediaCollection('avatar');
        }

        if($request->hasFile('cover') && $request->file('cover')->getClientOriginalName() !== 'blob'){
            $request->validate([
                'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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

    public function destroy()
    {
        $account = auth('accounts')->user();
        $account->delete();

        Toast::success('Account deleted successfully')->autoDismiss(2);
        auth('accounts')->logout();
        return redirect()->route('account.login');
    }
}
