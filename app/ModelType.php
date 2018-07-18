<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'model_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[ 'name','code','sizes'];
    public function items()
    {
        return $this->belongsToMany('App\Item');
    }
    public function setSizesAttribute($value)
    {
        $value = array_combine ($value,$value);
        $this->attributes['sizes'] =  serialize($value);
    }
    public function getSizesAttribute($value)
    {
        if($value=="")
        {
            $value="a:0:{}";
        }
        $value=array_values(unserialize($value)) ;
        return array_combine ($value,$value);
    }
}
