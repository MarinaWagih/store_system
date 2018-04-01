<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                                'date',
                                'additional_discount_percentage',
                                'total_after_sales_tax'
                                ];
    /**
     * @var array Of dates to be treated as Carbon Object
     */
    protected $dates = ['date'];
    public function items()
    {
        return $this->belongsToMany('App\Item')
            ->withPivot('quantity', 'price', 'discount_percent','size');
    }

    public function getDateAttribute()
    {

        return Carbon::parse($this->attributes['date'])->toDateString();
    }
    public function totalBeforeDiscount()
    {
        $sum=0;
        foreach($this->items as $item)
        {
            $sum+=$item->pivot->price*$item->pivot->quantity;
        }
        return $sum;
    }
    public function totalDiscount()
    {
        $sum=0;
        foreach($this->items as $item)
        {
            $sum+=($item->pivot->price*$item->pivot->quantity)
                                            *($item->pivot->discount_percent/100);
        }
        return $sum;
    }
    public function totalAfterDiscount()
    {
        $sum=0;
        foreach($this->items as $item)
        {
            $sum+=($item->pivot->price-(($item->pivot->price)*
                    ($item->pivot->discount_percent/100)))*$item->pivot->quantity;
        }
        return $sum;
    }

}

