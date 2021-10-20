<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $table = 'comments';

    protected $fillable = ['comment', 'user_id', 'product_id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function date()
    {

        return $this->created_at->format('Y-m');
    }
}
