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
    protected $fillable =[ 'name','code','price',
                           'client_price','count',
                           'model_type_id','client_id',
                           'full_code',
                           'sizes_count','sizes'];
    public function invoices()
    {
        return $this->belongsToMany('App\Invoice')
            ->withPivot('quantity','price', 'discount_percent');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function modelType()
    {
        return $this->belongsTo('App\ModelType');
    }

    public function setSizesAttribute($value)
    {
//        dd(serialize($value));
        $this->attributes['sizes_count'] =  serialize($value);
    }
    public function getSizesAttribute()
    {
//        dd($this->attributes);
        return unserialize($this->attributes['sizes_count']);
    }
    public function save(array $options = [])
    {
        // before save code
        $this->attributes['sizes_count']="";
        parent::save();
        // after save code
    }

}

