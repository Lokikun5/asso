<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'category', 'page_content', 'file','image', 'active' ,
    ];

    public static function boot()
    {
        parent::boot();

        // Générer automatiquement le slug
        static::creating(function ($podcast) {
            $podcast->slug = Str::slug($podcast->name);
        });
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
