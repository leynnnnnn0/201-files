<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
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
