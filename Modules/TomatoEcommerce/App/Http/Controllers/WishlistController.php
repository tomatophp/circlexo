<?php

namespace Modules\TomatoEcommerce\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class WishlistController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoEcommerce\App\Models\Wishlist::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-ecommerce::wishlists.index',
            table: \Modules\TomatoEcommerce\App\Tables\WishlistTable::class
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
            model: \Modules\TomatoEcommerce\App\Models\Wishlist::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-ecommerce::wishlists.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoEcommerce\App\Models\Wishlist::class,
            validation: [
                            'account_id' => 'required|exists:accounts,id',
            'product_id' => 'required|exists:products,id'
            ],
            message: __('Wishlist updated successfully'),
            redirect: 'admin.wishlists.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Wishlist $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoEcommerce\App\Models\Wishlist $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::wishlists.show',
        );
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Wishlist $model
     * @return View
     */
    public function edit(\Modules\TomatoEcommerce\App\Models\Wishlist $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::wishlists.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoEcommerce\App\Models\Wishlist $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoEcommerce\App\Models\Wishlist $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'account_id' => 'sometimes|exists:accounts,id',
            'product_id' => 'sometimes|exists:products,id'
            ],
            message: __('Wishlist updated successfully'),
            redirect: 'admin.wishlists.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Wishlist $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoEcommerce\App\Models\Wishlist $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Wishlist deleted successfully'),
            redirect: 'admin.wishlists.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
