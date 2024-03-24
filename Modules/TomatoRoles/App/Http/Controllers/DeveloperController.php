<?php

namespace Modules\TomatoRoles\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use ProtoneMedia\Splade\Facades\Toast;

class DeveloperController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function check(Request $request): RedirectResponse
    {
        $request->validate([
            "password" => "required",
            "old" => "required",
        ]);

        if($request->get('password') === config('tomato-roles.developer_password')){
            session()->put('dev_password', Crypt::encrypt($request->get('password')));

            Toast::success('Developer Login Success')->autoDismiss(2);
            return redirect()->to($request->get('old'));
        }

        session()->put('dev_password', "");
        Toast::danger('Sorry Your Password Not Correct')->autoDismiss(2);
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->validate([
            "old" => "required",
        ]);

        session()->put('dev_password', "");
        Toast::success('Logout Success')->autoDismiss(2);
        return redirect()->to($request->get('old'));
    }
}
