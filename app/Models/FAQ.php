<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'category'];
    protected $table = 'faqs';


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
