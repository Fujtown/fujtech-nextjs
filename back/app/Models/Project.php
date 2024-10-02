<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'images',
        'service_id',
        'publish_date',
    ];

    protected $casts = [
        'images' => 'array',
        'publish_date' => 'date',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}

