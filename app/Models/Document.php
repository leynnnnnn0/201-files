<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'path',
        'description',
        'remarks'
    ];

    protected $appends = [
        'owner'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'owner_id');
    }

    public function getOwnerAttribute()
    {
        return $this->employee?->full_name ?? 'N/a';
    }
}
