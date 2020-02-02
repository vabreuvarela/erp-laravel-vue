<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'upc',
        'cost'
    ];

    public static function createOrUpdateItem($request, $item = null)
    {
        if (is_null($item)) {
            $item = self::create($request->all());
        } else {
            $item->update($request->all());
        }

        return $item;
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }
}
