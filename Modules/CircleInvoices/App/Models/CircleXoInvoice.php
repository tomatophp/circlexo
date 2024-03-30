<?php

namespace Modules\CircleInvoices\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
* @property \App\Models\Account $account_id
* @property string $uuid
* @property string $name
* @property string $email
* @property string $phone
* @property string $address
* @property string $company
* @property \Modules\CircleInvoices\App\Models\CircleXoContact $contact_id
* @property string $due_date
* @property string $invoice_date
* @property int $paid_amount
* @property string $payment_method
* @property string $payment_method_details
* @property int $total
* @property int $shipping
* @property int $discount
* @property int $vat
* @property string $type
* @property string $status
* @property string $currency
* @property string $notes
* @property string $template
 */
class CircleXoInvoice extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'account_id',
        'uuid',
        'billed_from',
        'billed_to',
        'shipped_to',
        'contact_id',
        'due_date',
        'invoice_date',
        'paid_amount',
        'payment_method',
        'payment_method_details',
        'total',
        'shipping',
        'discount',
        'tax',
        'type',
        'status',
        'currency',
        'notes',
        'template',
        'is_public'
    ];

    protected $casts = [
        'payment_method_details' => 'json',
        'is_public' => 'boolean'
    ];




    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function contact()
    {
        return $this->belongsTo(\Modules\CircleContacts\App\Models\CircleXoContact::class);
    }

    public function items()
    {
      return $this->hasMany(\Modules\CircleInvoices\App\Models\CircleXoInvoiceItem::class, 'invoice_id', 'id');
    }
}
