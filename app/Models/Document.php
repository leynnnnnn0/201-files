<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'document_detail_id',
        'owner_id',
        'name',
        'path',
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

    public function document_detail()
    {
        return $this->belongsTo(DocumentDetail::class);
    }
}
