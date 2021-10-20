<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class icon extends Model
{
    use HasFactory;
    protected $table = 'icons';
    protected $guarded;

    function icon()
    {
        return $this->belongsTo(options::class);
    }
}
