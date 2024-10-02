<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    protected $fillable = [
        'years_experience',
        'projects_done',
        'happy_clients',
        'expert_members',
    ];
}
