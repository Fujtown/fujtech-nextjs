<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'icon',
        'description',
        'points',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
