<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
        // Specify the table name if it doesn't follow Laravel's naming convention
        protected $table = 'faqs'; // Assuming your table is named 'faqs'

        // Define the fillable fields
        protected $fillable = [
            'question',
            'answer',
        ];
}
