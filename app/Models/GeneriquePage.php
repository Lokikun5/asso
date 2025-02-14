<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneriquePage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'meta_description', 'slug', 'content'];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
