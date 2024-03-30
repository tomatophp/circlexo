<?php

namespace Modules\CircleInvoices\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\CircleContacts\App\Models\CircleXoContact;
use Modules\CircleInvoices\App\Models\CircleXoInvoice;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CircleXoInvoiceController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\CircleInvoices\App\Models\CircleXoInvoice::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = CircleXoInvoice::query();
        $query->where('account_id', auth('accounts')->user()->id);

        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'circle-invoices::invoices.index',
            table: \Modules\CircleInvoices\App\Tables\CircleXoInvoiceTable::class,
            query: $query
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        $query = CircleXoInvoice::query();
        $query->where('account_id', auth('accounts')->user()->id);
        return Tomato::json(
            request: $request,
            model: \Modules\CircleInvoices\App\Models\CircleXoInvoice::class,
            query: $query
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'circle-invoices::invoices.create',
        );
    }

    /**
     * @param \Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice\CircleXoInvoiceStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice\CircleXoInvoiceStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->merge([
            "account_id" => auth('accounts')->user()->id,
            "total" => collect($request->get('items'))->sum('total'),
            "tax" => collect($request->get('items'))->map(function ($item) {
                return $item['tax'] * $item['qty'];
            })->sum(),
            "discount" => collect($request->get('items'))->map(function ($item) {
                return $item['discount'] * $item['qty'];
            })->sum(),
        ]);


        if($request->has('contact_id')){
            $contact = CircleXoContact::find($request->get('contact_id'));
            if($contact){
                $billedTo = $contact->name . "\n" . $contact->address . "\n" . $contact->email . "\n" . $contact->phone . "\n" . $contact->company;
            }

            $request->merge([
                "billed_to" => $billedTo ?? null,
                "shipped_to" => $billedTo ?? null,
            ]);
        }

        $response = Tomato::store(
            request: $request,
            model: \Modules\CircleInvoices\App\Models\CircleXoInvoice::class,
            message: __('Invoice saved successfully'),
            redirect: 'profile.invoices.index',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );

        foreach ($request->items as $item) {
            $response->record->items()->create($item);
        }

        auth('accounts')->user()->meta('billed_from', $request->billed_from);
        if($request->hasFile('logo') && auth('accounts')->user()->getMedia('logo')->count() < 1){
            auth('accounts')->user()->addMedia($request->logo)->toMediaCollection('logo');
        }

        if($response instanceof JsonResponse){
            return $response;
        }

        return redirect()->route('profile.invoices.show', $response->record->id);
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoice $model
     * @return View|JsonResponse
     */
    public function show(\Modules\CircleInvoices\App\Models\CircleXoInvoice $model): View|JsonResponse
    {
        if(!has_app('circle-invoices', $model->account_id)){
            abort(403);
        }

        return Tomato::get(
            model: $model,
            view: 'circle-invoices::invoices.show',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );
    }


    public function print(\Modules\CircleInvoices\App\Models\CircleXoInvoice $model): View|JsonResponse
    {
        if(!has_app('circle-invoices', $model->account_id)){
            abort(403);
        }


        return Tomato::get(
            model: $model,
            view: 'circle-invoices::invoices.print',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );
    }

    public function showPublic($invoice): View|JsonResponse
    {
        $invoice = CircleXoInvoice::where('uuid', $invoice)->first();

        if($invoice){
            if($invoice->is_public){
                return view('circle-invoices::invoices.public', [
                    'invoice' => $invoice
                ]);
            }
            else {
                abort(403);
            }
        }
        else {
            abort(404);
        }

    }

    public function printPublic($invoice): View|JsonResponse
    {
        $invoice = CircleXoInvoice::where('uuid', $invoice)->first();

        if($invoice){
            if($invoice->is_public){
                return view('circle-invoices::invoices.print-public', [
                    'invoice' => $invoice
                ]);
            }
            else {
                abort(403);
            }
        }
        else {
            abort(404);
        }
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoice $model
     * @return View
     */
    public function edit(\Modules\CircleInvoices\App\Models\CircleXoInvoice $model): View
    {
        if(!has_app('circle-invoices', $model->account_id)){
            abort(403);
        }


        $model->items = $model->items;
        return Tomato::get(
            model: $model,
            view: 'circle-invoices::invoices.edit',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );
    }

    /**
     * @param \Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice\CircleXoInvoiceUpdateRequest $request
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoice $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice\CircleXoInvoiceUpdateRequest $request, \Modules\CircleInvoices\App\Models\CircleXoInvoice $model): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-invoices', $model->account_id)){
            abort(403);
        }


        $request->merge([
            "total" => collect($request->get('items'))->sum('total'),
            "tax" => collect($request->get('items'))->map(function ($item) {
                return $item['tax'] * $item['qty'];
            })->sum(),
            "discount" => collect($request->get('items'))->map(function ($item) {
                return $item['discount'] * $item['qty'];
            })->sum(),
        ]);

        if($request->has('contact_id') && empty($request->billed_to) && empty($request->shipped_to)){
            $contact = CircleXoContact::find($request->get('contact_id'));
            if($contact){
                $billedTo = $contact->name . "\n" . $contact->address . "\n" . $contact->email . "\n" . $contact->phone . "\n" . $contact->company;
            }

            $request->merge([
                "billed_to" => $billedTo ?? null,
                "shipped_to" => $billedTo ?? null,
            ]);
        }


        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Invoice updated successfully'),
            redirect: 'profile.invoices.index',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );

        $response->record->items()->delete();
        foreach ($request->items as $item) {
            $response->record->items()->create($item);
        }

        auth('accounts')->user()->meta('billed_from', $request->billed_from);
        if($request->hasFile('logo') && $request->file('logo')->getClientOriginalName() !== 'blob'){
            auth('accounts')->user()->clearMediaCollection('logo');
            auth('accounts')->user()->addMedia($request->logo)->toMediaCollection('logo');
        }

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \Modules\CircleInvoices\App\Models\CircleXoInvoice $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\CircleInvoices\App\Models\CircleXoInvoice $model): RedirectResponse|JsonResponse
    {
        if(!has_app('circle-invoices', $model->account_id)){
            abort(403);
        }

        $model->items()->delete();
        $response = Tomato::destroy(
            model: $model,
            message: __('Invoice deleted successfully'),
            redirect: 'profile.invoices.index',
            hasMedia: true,
            collection: [
                'logo' => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
