<?php

namespace Modules\CircleInvoices\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
* @property string $item
* @property int $price
* @property int $discount
* @property int $vat
* @property int $qty
* @property int $total
* @property string $is_free
* @property \Modules\CircleInvoices\App\Models\CircleXoInvoice $invoice_id
* @property string $description
 */
class CircleXoInvoiceItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'item',
        'price',
        'discount',
        'tax',
        'qty',
        'total',
        'is_free',
        'invoice_id',
        'description'
    ];

    protected $casts = [
        'is_free' => 'boolean'
    ];



    public function invoice()
    {
        return $this->belongsTo(\Modules\CircleInvoices\App\Models\CircleXoInvoice::class);
    }
}
