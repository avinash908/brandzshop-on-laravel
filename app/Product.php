<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Size;
use App\Color;
use App\Brand;
use App\Category;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    use Rateable;
    use \Conner\Tagging\Taggable;
    
    protected $fillable = [
    	'name', 'slug', 'price', 'description', 'brand_id', 'old_price', 'percent_off', 'is_new', 'stock', 'video',
    ];
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function subcategories()
    {
        return $this->belongsToMany('App\SubCategory');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
    public function image(){
        return $this->morphOne('App\Image','imageable');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
