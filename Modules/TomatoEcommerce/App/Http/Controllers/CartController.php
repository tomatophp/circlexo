<?php

namespace Modules\TomatoEcommerce\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CartController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoEcommerce\App\Models\Cart::class;
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
            view: 'tomato-ecommerce::carts.index',
            table: \Modules\TomatoEcommerce\App\Tables\CartTable::class
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
            model: \Modules\TomatoEcommerce\App\Models\Cart::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-ecommerce::carts.create',
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
            model: \Modules\TomatoEcommerce\App\Models\Cart::class,
            validation: [
                            'account_id' => 'nullable|exists:accounts,id',
            'product_id' => 'nullable|exists:products,id',
            'session_id' => 'nullable|max:255|string',
            'item' => 'required|max:255|string',
            'price' => 'required',
            'discount' => 'nullable',
            'vat' => 'nullable',
            'qty' => 'nullable',
            'total' => 'nullable',
            'note' => 'nullable|max:65535',
            'options' => 'nullable',
            'is_active' => 'nullable'
            ],
            message: __('Cart updated successfully'),
            redirect: 'admin.carts.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Cart $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoEcommerce\App\Models\Cart $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::carts.show',
        );
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Cart $model
     * @return View
     */
    public function edit(\Modules\TomatoEcommerce\App\Models\Cart $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-ecommerce::carts.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoEcommerce\App\Models\Cart $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoEcommerce\App\Models\Cart $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'account_id' => 'nullable|exists:accounts,id',
            'product_id' => 'nullable|exists:products,id',
            'session_id' => 'nullable|max:255|string',
            'item' => 'sometimes|max:255|string',
            'price' => 'sometimes',
            'discount' => 'nullable',
            'vat' => 'nullable',
            'qty' => 'nullable',
            'total' => 'nullable',
            'note' => 'nullable|max:65535',
            'options' => 'nullable',
            'is_active' => 'nullable'
            ],
            message: __('Cart updated successfully'),
            redirect: 'admin.carts.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\TomatoEcommerce\App\Models\Cart $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoEcommerce\App\Models\Cart $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Cart deleted successfully'),
            redirect: 'admin.carts.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
