<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'description', 'text', 'slug', 'partner_link','profile_picture'];

    /**
     * Générer un slug automatiquement avant la création du partenaire.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($partner) {
            $partner->slug = Str::slug($partner->first_name . ' ' . $partner->last_name, '-');
        });
    }

    public function getProfilePictureAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('storage/default-profile.webp');
    }

}