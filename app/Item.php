<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[ 'name','code', 'picture', 'price',
                           'client_price','count','unit'];
    public function invoices()
    {
        return $this->belongsToMany('App\Invoice')
            ->withPivot('quantity','price', 'discount_percent');
    }
}

