<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_discounts extends Model
{
    use HasFactory;
    protected $table = 'product_discounts';
    protected $guarded;

    function products()
    {
        return $this->hasMany(Product::class);
    }

    public function discount_type()
    {
        if ($this->type == 1) {
            return $this->value;
        }elseif ($this->type == 0) {
            return $this->value . ' ' . '%';
        }
    }

}
