<?php

namespace Modules\CircleNotes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\CircleNotes\App\Models\CircleXoNote;
use Modules\CircleNotes\App\Models\CircleXoNoteLink;
use Modules\CircleNotes\App\Models\CircleXoNoteUserPermission;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoNoteShareController extends Controller
{
    public function share(CircleXoNote $model)
    {
        if (!has_app('circle-notes', $model->account_id)) {
            abort(403);
        }

        return Tomato::get(
            model: $model,
            view: 'circle-notes::notes.share',
        );
    }


    public function showShareLink($username, $slug)
    {
        $note = CircleXoNote::where('slug', $slug)->firstOrFail();
        if($note->is_public) {
            $account = Account::where('username', $username)->firstOrFail();

            return view('circle-notes::notes.share_page', compact('note', 'account'));
        }
        else {
            abort(404);
        }
    }

    public function generateOneTimeLink(CircleXoNote $model)
    {
        $token = Str::random(10);

        if(!$model->links()->count()){
            CircleXoNoteLink::create([
                'note_id' => $model->id,
                'token' => $token
            ]);

            Toast::success(__('Generate one time link successfully'))->autoDismiss(2);
        }
        else {
            Toast::danger(__('One time link already generated'))->autoDismiss(2);
        }


        return back();
    }

    public function showShareOneTimeLink($username, $token)
    {
        $noteLink = CircleXoNoteLink::where('token', $token)->firstOrFail();
        $note = $noteLink->note;

        $account = Account::where('username', $username)->firstOrFail();

        // Remove the token once it's been used
        $noteLink->delete();

        return view('circle-notes::notes.share_page', compact('note', 'account'));
    }
}
