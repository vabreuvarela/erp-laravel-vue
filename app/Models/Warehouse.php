<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'debt'
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

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
