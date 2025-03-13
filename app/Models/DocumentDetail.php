<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDetail extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'office_number',
        'special_number',
        'description',
        'person_indicated',
        'remarks'
    ];
}
