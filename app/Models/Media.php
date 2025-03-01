<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_name', 'article_id', 'podcast_id'];

    // Relation avec un article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

     // Relation avec un podcast   
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }


}
