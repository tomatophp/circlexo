<?php

namespace Modules\TomatoCrm\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoCrm\App\Models\Contact;

class ContactController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: Contact::class,
            view: 'tomato-crm::contacts.index',
            table: \Modules\TomatoCrm\App\Tables\ContactTable::class,
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \Modules\TomatoCrm\App\Models\Contact::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View|JsonResponse
    {
        return Tomato::create(
            view: 'tomato-crm::contacts.create',
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Http\Requests\Contact\ContactStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoCrm\App\Http\Requests\Contact\ContactStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCrm\App\Models\Contact::class,
            message: __('Contact created successfully'),
            redirect: 'admin.contacts.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Contact $model
     * @return View
     */
    public function show(\Modules\TomatoCrm\App\Models\Contact $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts.show',
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Contact $model
     * @return View
     */
    public function edit(\Modules\TomatoCrm\App\Models\Contact $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts.edit',
        );
    }

    /**
     * @param \Modules\TomatoCrm\App\Http\Requests\Contact\ContactUpdateRequest $request
     * @param \Modules\TomatoCrm\App\Models\Contact $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoCrm\App\Http\Requests\Contact\ContactUpdateRequest $request, \Modules\TomatoCrm\App\Models\Contact $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Contact updated successfully'),
            redirect: 'admin.contacts.index',
        );

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoCrm\App\Models\Contact $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoCrm\App\Models\Contact $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Contact deleted successfully'),
            redirect: 'admin.contacts.index',
        );

        return $response->redirect;
    }
    /**
     * @param \Modules\TomatoCrm\App\Models\Contact $model
     * @return RedirectResponse
     */
    public function close(\Modules\TomatoCrm\App\Models\Contact $model): RedirectResponse|JsonResponse
    {
        $model->update(['active' => false]);

        Toast::success(__('Contact closed successfully'))->autoDismiss(2);
        return back();
    }
}
