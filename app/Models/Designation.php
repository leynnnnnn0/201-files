<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /** @use HasFactory<\Database\Factories\DesignationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'remarks'
    ];

    public function scopeGetOptions(Builder $query)
    {
        return $query->select(['name', 'id'])->get()->map(function ($position) {
            return [
                'value' => str($position->id),
                'label' => $position->name
            ];
        });
    }
}
