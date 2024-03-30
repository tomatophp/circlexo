<?php

namespace Modules\CircleInvoices\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CircleXoInvoicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
            'account' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'company' => $this->company,
            'contact' => $this->id,
            'due_date' => $this->due_date,
            'invoice_date' => $this->invoice_date,
            'paid_amount' => $this->paid_amount,
            'payment_method' => $this->payment_method,
            'payment_method_details' => $this->payment_method_details,
            'total' => $this->total,
            'shipping' => $this->shipping,
            'discount' => $this->discount,
            'vat' => $this->vat,
            'type' => $this->type,
            'status' => $this->status,
            'currency' => $this->currency,
            'notes' => $this->notes,
            'template' => $this->template,

        ];
    }
}
