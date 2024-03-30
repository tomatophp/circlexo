<?php

namespace Modules\CircleInvoices\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoInvoiceItemController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem::class;
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
            view: 'circleinvoices::circle-xo-invoice-items.index',
            table: \Modules\CircleInvoices\App\Tables\CircleXoInvoiceItemTable::class
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
            model: \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circleinvoices::circle-xo-invoice-items.create',
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
            model: \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem::class,
            validation: [
                            'item' => 'required|max:255|string',
            'price' => 'nullable',
            'discount' => 'nullable',
            'vat' => 'nullable',
            'qty' => 'nullable',
            'total' => 'nullable',
            'is_free' => 'nullable',
            'invoice_id' => 'required|exists:circle_xo_invoices,id',
            'description' => 'nullable|max:255|string'
            ],
            message: __('CircleXoInvoiceItem updated successfully'),
            redirect: 'admin.circle-xo-invoice-items.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'circleinvoices::circle-xo-invoice-items.show',
        );
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model
     * @return View
     */
    public function edit(\Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'circleinvoices::circle-xo-invoice-items.edit',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'item' => 'sometimes|max:255|string',
            'price' => 'nullable',
            'discount' => 'nullable',
            'vat' => 'nullable',
            'qty' => 'nullable',
            'total' => 'nullable',
            'is_free' => 'nullable',
            'invoice_id' => 'sometimes|exists:circle_xo_invoices,id',
            'description' => 'nullable|max:255|string'
            ],
            message: __('CircleXoInvoiceItem updated successfully'),
            redirect: 'admin.circle-xo-invoice-items.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleInvoices\App\Models\CircleXoInvoiceItem $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('CircleXoInvoiceItem deleted successfully'),
            redirect: 'admin.circle-xo-invoice-items.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
