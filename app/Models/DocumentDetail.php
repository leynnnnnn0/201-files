<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentDetail extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentDetailFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'office_number',
        'special_number',
        'description',
        'person_indicated',
        'remarks'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
