<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'img_banner', 'type', 'text', 'slug'];

    // Relation avec Media
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);  // Génère le slug à partir du titre
        });

        static::updating(function ($article) {
            $article->slug = Str::slug($article->title);  // Met à jour le slug si le titre change
        });
    }
}
