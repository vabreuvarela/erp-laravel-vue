<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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
