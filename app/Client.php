<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'code',
        'address',
        'phone',
        'trading_name',
        'trading_address',
        'date',
        'date',
        'mobile',
        'fax'
    ];
    /**
     * @var array Of dates to be treated as Carbon Object
     */
    protected $dates = ['date'];

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
