<?php

namespace Modules\CircleContacts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\CircleContacts\App\Http\Requests\CircleXoContact\CircleXoContactStoreRequest;
use Modules\CircleContacts\App\Http\Requests\CircleXoContact\CircleXoContactUpdateRequest;
use Modules\CircleContacts\App\Models\CircleXoContact;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoContactController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleContacts\App\Models\CircleXoContact::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = CircleXoContact::query();
        $query->where('account_id', auth('accounts')->user()->id);
        if($request->has('group_id')){
            $query->whereHas('groups', function ($query) use ($request){
                $query->where('id', $request->get('group_id'));
            });
        }

        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'circle-contacts::contacts.index',
            table: \Modules\CircleContacts\App\Tables\CircleXoContactTable::class,
            query: $query
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        $query = CircleXoContact::query();
        $query->where('account_id', auth('accounts')->user()->id);
        return Tomato::json(
            request: $request,
            model: \Modules\CircleContacts\App\Models\CircleXoContact::class,
            query: $query
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-contacts::contacts.create',
        );
    }

    /**
     * @param CircleXoContactStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(CircleXoContactStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->merge([
           "account_id" => auth('accounts')->user()->id
        ]);
        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleContacts\App\Models\CircleXoContact::class,
            message: __('Contact saved successfully'),
            redirect: 'profile.contacts.index',
            hasMedia: true,
            collection: [
                'avatar' => false,
            ]
        );

        $response->record->groups()->sync($request->get('groups'));

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContact $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleContacts\App\Models\CircleXoContact $model): View|JsonResponse
    {
        if(!has_app('circle-contacts', $model->account_id)){
            abort(403);
        }

        return Tomato::get(
            model: $model,
            view: 'circle-contacts::contacts.show',
            hasMedia: true,
            collection: [
                'avatar' => false,
            ]
        );
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContact $model
     * @return View
     */
    public function edit(\Modules\CircleContacts\App\Models\CircleXoContact $model): View
    {
        if(!has_app('circle-contacts', $model->account_id)){
            abort(403);
        }

        $model->groups = $model->groups->pluck('id')->toArray();
        return Tomato::get(
            model: $model,
            view: 'circle-contacts::contacts.edit',
            hasMedia: true,
            collection: [
                'avatar' => false,
            ]
        );
    }

    /**
     * @param CircleXoContactUpdateRequest $request
     * @param \Modules\CircleContacts\App\Models\CircleXoContact $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(CircleXoContactUpdateRequest $request, \Modules\CircleContacts\App\Models\CircleXoContact $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Contact updated successfully'),
            redirect: 'profile.contacts.index',
            hasMedia: true,
            collection: [
                'avatar' => false,
            ]
        );

        $response->record->groups()->sync($request->get('groups'));

        if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \Modules\CircleContacts\App\Models\CircleXoContact $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleContacts\App\Models\CircleXoContact $model): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-contacts', $model->account_id)){
            abort(403);
        }

        $model->groups()->detach();
        $model->contactMeta()->delete();
        $response = Tomato::destroy(
            model: $model,
            message: __('Contact deleted successfully'),
            redirect: 'profile.contacts.index',
            hasMedia: true,
            collection: [
                'avatar' => false,
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return redirect()->route('profile.contacts.index');
    }
}
