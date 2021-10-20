<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded;


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function options()
    {
        return $this->hasMany(product_options::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Subcategory()
    {
        return $this->hasMany(subcategory::class);
    }

    public function discount()
    {
        return $this->belongsTo(product_discounts::class, 'product_discount_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media()
    {
        return $this->hasMany(Product_images::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(order::class);
    }

     public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    
}
