<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    protected $casts = [
        'product_id' => 'integer',
        'warehouse_id' => 'integer'
    ];

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'wholesale_price',
        'retail_price',
        'quantity'
    ];

    public static function createOrUpdateItem($request, $item = null)
    {
        if (is_null($item)) {
            $item = self::create($request->all());
        } else {
            $item->update($request->except(['product_id', 'warehouse_id']));
        }

        return $item;
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
