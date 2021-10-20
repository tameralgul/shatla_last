<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $guarded;



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
