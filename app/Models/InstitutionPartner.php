<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionPartner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category', 'active'];

    public function getIconAttribute($value)
    {
        $defaultIcons = [
            'Écoles et universités' => 'fas fa-school',
            'Entreprises du secteur privé' => 'fas fa-building',
            'Services publics' => 'fas fa-landmark',
        ];

        return $value ?? ($defaultIcons[$this->category] ?? 'fas fa-handshake');
    }

}
