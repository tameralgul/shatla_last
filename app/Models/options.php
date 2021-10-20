<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class options extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $guarded;

    function icon()
    {
        return $this->hasOne(icon::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_options');
    }

}
