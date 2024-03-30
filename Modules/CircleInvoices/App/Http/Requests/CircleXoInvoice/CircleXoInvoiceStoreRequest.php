<?php

namespace Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoInvoiceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'items' => 'required|array|min:1',
            'uuid' => 'required|max:255|string|unique:circle_xo_invoices,uuid',
            'billed_from' => 'required|string',
            'billed_to' => 'nullable|string',
            'shipped_to' => 'nullable|string',
            'contact_id' => 'nullable|exists:circle_xo_contacts,id',
            'due_date' => 'required|date',
            'invoice_date' => 'required|date',
            'paid_amount' => 'nullable',
            'payment_method' => 'required|max:255|string',
            'payment_method_details' => 'nullable',
            'total' => 'nullable',
            'shipping' => 'nullable',
            'discount' => 'nullable',
            'tax' => 'nullable',
            'type' => 'nullable|max:255|string',
            'status' => 'nullable|max:255|string',
            'currency' => 'nullable|max:255|string',
            'notes' => 'nullable',
            'is_public' => 'nullable|boolean',
            'template' => 'nullable|max:255|string'
        ];
    }
}
