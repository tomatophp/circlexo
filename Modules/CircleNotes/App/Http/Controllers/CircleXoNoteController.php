<?php

namespace Modules\CircleNotes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Modules\CircleNotes\App\Http\Requests\CircleXoNote\CircleXoNoteStoreRequest;
use Modules\CircleNotes\App\Http\Requests\CircleXoNote\CircleXoNoteUpdateRequest;
use Modules\CircleNotes\App\Models\CircleXoNote;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoNoteController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = CircleXoNote::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = CircleXoNote::query();
        $query->where('account_id', auth('accounts')->user()->id);

        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'circle-notes::notes.index',
            table: \Modules\CircleNotes\App\Tables\CircleXoNoteTable::class,
            query: $query
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-notes::notes.create',
        );
    }

    /**
     * @param CircleXoNoteStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(CircleXoNoteStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->merge([
            "slug" => Str::random(10),
            "account_id" => auth('accounts')->user()->id
        ]);

        $response = Tomato::store(
            request: $request,
            model: CircleXoNote::class,
            message: __('Note saved successfully'),
            redirect: 'profile.notes.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return redirect()->route('profile.notes.show', $response->record->id);
    }

    /**
     * @param CircleXoNote $model
     * @return View|JsonResponse
     */
    public function show(CircleXoNote $model): View|JsonResponse
    {
        if (!has_app('circle-notes', $model->account_id)) {
            abort(403);
        }

        return Tomato::get(
            model: $model,
            view: 'circle-notes::notes.show',
        );
    }

    /**
     * @param CircleXoNote $model
     * @return View
     */
    public function edit(CircleXoNote $model): View
    {
        if (!has_app('circle-notes', $model->account_id)) {
            abort(403);
        }

        return Tomato::get(
            model: $model,
            view: 'circle-notes::notes.edit',
        );
    }

    /**
     * @param CircleXoNoteUpdateRequest $request
     * @param CircleXoNote $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(CircleXoNoteUpdateRequest $request, CircleXoNote $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Note updated successfully'),
            redirect: 'profile.notes.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return redirect()->route('profile.notes.show', $model->id);
    }

    /**
     * @param CircleXoNote $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(CircleXoNote $model): RedirectResponse|JsonResponse
    {
        if (!has_app('circle-notes', $model->account_id)) {
            abort(403);
        }

        $response = Tomato::destroy(
            model: $model,
            message: __('Note deleted successfully'),
            redirect: 'profile.notes.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return redirect()->route('profile.notes.index');
    }
}
