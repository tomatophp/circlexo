<?php

namespace Modules\TomatoCms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: \Modules\TomatoCms\App\Models\Comment::class,
            view: 'tomato-cms::comments.index',
            table: \Modules\TomatoCms\App\Tables\CommentTable::class,
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
            model: \Modules\TomatoCms\App\Models\Comment::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-cms::comments.create',
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Http\Requests\Comment\CommentStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\Modules\TomatoCms\App\Http\Requests\Comment\CommentStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoCms\App\Models\Comment::class,
            message: __('Comment created successfully'),
            redirect: 'admin.comments.index',
        );

        return redirect()->back();
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Comment $model
     * @return View
     */
    public function show(\Modules\TomatoCms\App\Models\Comment $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::comments.show',
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Comment $model
     * @return View
     */
    public function edit(\Modules\TomatoCms\App\Models\Comment $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-cms::comments.edit',
        );
    }

    /**
     * @param \Modules\TomatoCms\App\Http\Requests\Comment\CommentUpdateRequest $request
     * @param \Modules\TomatoCms\App\Models\Comment $user
     * @return RedirectResponse
     */
    public function update(\Modules\TomatoCms\App\Http\Requests\Comment\CommentUpdateRequest $request, \Modules\TomatoCms\App\Models\Comment $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Comment updated successfully'),
            redirect: 'admin.comments.index',
        );

        return redirect()->back();
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Comment $model
     * @return RedirectResponse
     */
    public function destroy(\Modules\TomatoCms\App\Models\Comment $model): RedirectResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Comment deleted successfully'),
            redirect: 'admin.comments.index',
        );

        return $response->redirect;

    }
}
