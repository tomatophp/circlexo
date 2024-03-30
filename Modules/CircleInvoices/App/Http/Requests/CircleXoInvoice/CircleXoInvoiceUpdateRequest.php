<?php

namespace Modules\CircleInvoices\App\Http\Requests\CircleXoInvoice;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoInvoiceUpdateRequest extends FormRequest
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
            'billed_from' => 'required|string',
            'billed_to' => 'nullable|string',
            'shipped_to' => 'nullable|string',
            'contact_id' => 'nullable|exists:circle_xo_contacts,id',
            'due_date' => 'nullable',
            'invoice_date' => 'nullable',
            'paid_amount' => 'nullable',
            'payment_method' => 'nullable|max:255|string',
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
